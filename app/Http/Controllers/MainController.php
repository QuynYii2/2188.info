<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\Contains;
use App\Enums\ProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use FuzzyWuzzy\Fuzz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function insertProduct($serve)
    {
        $categoryDefault = Category::where('status', CategoryStatus::ACTIVE)->get();

        switch ($serve) {
            case 'shipgo':
                $products = $this->getAllProductFromShipGo();
                foreach ($products as $item) {
                    $product = new Product();
                    $product->name = $item->Name;

                    $language = $this->getLanguageCode((new TranslateController())->detectLanguage($item->Name));

                    $ld = new TranslateController();

                    $product->name_vi = $ld->translateText($item->Name, 'vi');
                    $product->name_ja = $ld->translateText($item->Name, 'ja');
                    $product->name_ko = $ld->translateText($item->Name, 'ko');
                    $product->name_en = $ld->translateText($item->Name, 'en');
                    $product->name_zh = $ld->translateText($item->Name, 'zh-CN');

                    $product->description = $item->FullDescription;

                    $product->description_vi = $ld->translateText($item->FullDescription, 'vi');
                    $product->description_ja = $ld->translateText($item->FullDescription, 'ja');
                    $product->description_ko = $ld->translateText($item->FullDescription, 'ko');
                    $product->description_en = $ld->translateText($item->FullDescription, 'en');
                    $product->description_zh = $ld->translateText($item->FullDescription, 'zh-CN');

                    $product->short_description = $item->ShortDescription;

                    $product->short_description_vi = $ld->translateText($item->ShortDescription, 'vi');
                    $product->short_description_ja = $ld->translateText($item->ShortDescription, 'ja');
                    $product->short_description_ko = $ld->translateText($item->ShortDescription, 'ko');
                    $product->short_description_en = $ld->translateText($item->ShortDescription, 'en');
                    $product->short_description_zh = $ld->translateText($item->ShortDescription, 'zh-CN');

                    $product->price = $item->Price;
                    $product->old_price = $item->OldPrice;
                    $product->min = $item->OrderMinimumQuantity;
                    $product->slug = $item->Sku;

                    $product->hot = 0;
                    $product->feature = 0;
                    $product->views = 0;

                    $product->origin = $language;
                    $product->location = $language;

                    $product->product_code = 'SG-P-' . (new HomeController())->generateRandomString(8);

                    $role = Role::where('name', 'super_admin')->first();
                    $adminRole = DB::table('role_user')->where('role_id' . $role->id)->first();

                    $product->user_id = $adminRole->user_id;

                    $category = $item->category;
                    $arrayNameCategory = $this->getCategoryIds($category, $categoryDefault);

                    if (empty($arrayNameCategory)) {
                        $arrayNameCategory[] = $categoryDefault[0]->id;
                    }

                    $detail_category = $arrayNameCategory[0]->id;

                    $list_category = implode(',', $arrayNameCategory);

                    $product->category_id = $detail_category;
                    $product->list_category = $list_category;

                    $product->thumbnail = $language;
                    $product->gallery = $language;

                    $product->status = ProductStatus::ACTIVE;

//                    $product->save();
                }

                break;
            default:
                break;
        }
    }

    private function getCategoryIds($categoryCompany, $categoryDefault)
    {
        $fuzz = new Fuzz();
        $arrayNameCategory = [];

        $properties = ['name_ja', 'name_ko', 'name_en', 'name_zh'];

        foreach ($categoryDefault as $category) {
            foreach ($properties as $property) {
                try {
                    $value = $fuzz->ratio($category->$property, $categoryCompany);
                } catch (Exception $exception) {
                    $value = 0;
                }

                if ($value > 50) {
                    $arrayNameCategory[] = $category->id;
                    break;
                }
            }
        }

        return $arrayNameCategory;
    }

    private function getLanguageCode($language)
    {
        switch ($language) {
            case 'zh-CN':
                return 'cn';
            case 'ko':
                return 'kr';
            case 'jp':
                return 'jp';
            default:
                return 'vi';
        }
    }

    private function getAllProductFromShipGo()
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_ACTIVE;
            $url_local = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_LOCAL_ACTIVE;
            $response = Http::get($url_local);
            $data = $response->body();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
