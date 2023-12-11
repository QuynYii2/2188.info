<?php

namespace App\Http\Controllers;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Enums\CategoryStatus;
use App\Enums\Contains;
use App\Enums\ProductStatus;
use App\Enums\PropertiStatus;
use App\Enums\VariationStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Properties;
use App\Models\Role;
use App\Models\Variation;
use FuzzyWuzzy\Fuzz;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function insertProduct()
    {
        try {
            $role = Role::where('name', 'super_admin')->first();
            $adminRole = DB::table('role_user')->where('role_id', $role->id)->first();

            $categoryDefault = Category::where('status', CategoryStatus::ACTIVE)->get();

            $attributes = $this->getAllAttributeFromShipGo();
            $dataAttribute = json_decode($attributes, true);

            foreach ($dataAttribute as $att) {
                $attribute = $this->createAttribute($att, 'Name', $adminRole);
            }

            $categories = $this->getAllCategoryFromShipGo();
            $dataArray = json_decode($categories, true);
            foreach ($dataArray as $item) {
                if ($item) {
                    $category = $item['Name'];
                    $categoryID = $item['Id'];

                    $arrayNameCategory = $this->getCategoryIds($category, $categoryDefault);

                    if (empty($arrayNameCategory)) {
                        $arrayNameCategory[] = $categoryDefault[0]->id;
                    }

                    $detail_category = $arrayNameCategory[0];

                    $list_category = implode(',', $arrayNameCategory);

                    $products = $this->getProductByCategoryFromShipGo($categoryID);
                    $productsList = json_decode($products, true);
                    foreach ($productsList as $value) {
                        $productID = $value['Id'];

                        $product = Product::where('serve_id', $productID)->where('serve', 'shipgo')->first();
                        if (!$product) {
                            $product = new Product();

                            $product->serve = 'shipgo';
                            $product->serve_id = $productID;

                            $product->category_id = $detail_category;
                            $product->list_category = $list_category;

                            $picture = $this->getProductPicture($productID);
                            $pictures = $this->getAllProductPictures($productID);

                            $thumbnail = null;
                            $gallery = null;

                            $picture = json_decode($picture, true);
                            $pictures = json_decode($pictures, true);
                            if ($picture) {
                                $thumbnail = $this->getProductPictureDetail($picture['PictureId']);
                                if (!$thumbnail) {
                                    $thumbnail = '';
                                } else {
                                    $thumbnail = str_replace("wwwroot/", "", $thumbnail);

                                    $thumbnail = $this->checkServeImage($thumbnail);
                                }

                                foreach ($pictures as $p) {
                                    $pic = $this->getProductPictureDetail($p['PictureId']);
                                    $pic = str_replace("wwwroot/", "", $pic);
                                    if (!$gallery) {
                                        $gallery = $this->checkServeImage($pic);
                                    } else {
                                        $gallery = $gallery . ',' . $this->checkServeImage($pic);
                                    }

                                }

                                $product->user_id = $adminRole->user_id;

                                $product->thumbnail = $thumbnail;
                                $product->gallery = $gallery;

                                $product = $this->createProduct($product, $value);

//                                dd($productID);
                                $attributeProduct = $this->getAllProductAttributeFromShipGo($productID);
                                $dataAttributeProduct = json_decode($attributeProduct, true);

                                if (count($dataAttributeProduct) > 0) {
                                    foreach ($dataAttributeProduct as $itemAttributeProduct) {
                                        $attribute = Attribute::where('serve', 'shipgo')->where('serve_id', $itemAttributeProduct['ProductAttributeId'])->first();

                                        $attributeProductValue = $this->getAllProductAttributeValueFromShipGo($itemAttributeProduct['Id']);
                                        $dataAttributeProductValue = json_decode($attributeProductValue, true);

                                        $arrayProperty = null;
                                        foreach ($dataAttributeProductValue as $itemAttributeProductValue) {
                                            $property = new Properties();
                                            $property->attribute_id = $attribute->id;
                                            $property = $this->createProperty($property, 'Name', $itemAttributeProductValue);

                                            $attribute_property = $attribute->id . '-' . $property->id;

                                            $variation = new Variation();

                                            $variation->user_id = $adminRole->user_id;

                                            $variation->quantity = $itemAttributeProductValue['Quantity'];

                                            $variation->price = $product->price * (1 + $itemAttributeProductValue['PriceAdjustment']);
                                            $variation->old_price = $product->old_price * (1 + $itemAttributeProductValue['PriceAdjustment']);

                                            $thumbnail = $this->getProductPictureDetail($itemAttributeProductValue['PictureId']);
                                            if (!$thumbnail) {
                                                $thumbnail = '';
                                            } else {
                                                $thumbnail = str_replace("wwwroot/", "", $thumbnail);

                                                $thumbnail = $this->checkServeImage($thumbnail);
                                            }

                                            $variation->thumbnail = $thumbnail;

                                            $variation->variation = $attribute_property;

                                            $variation->description = '';
                                            $variation->status = VariationStatus::ACTIVE;

                                            $arrayProperty[] = $property->id;
                                        }

                                        $listProperty = implode(',', $arrayProperty);

                                        $attribute_property = [
                                            'product_id' => $product->id,
                                            'attribute_id' => $attribute->id,
                                            'value' => $listProperty,
                                            'status' => AttributeProductStatus::ACTIVE
                                        ];
                                        DB::table('product_attribute')->insert($attribute_property);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    private function getAttributeProperty($request)
    {
        $proAtt = $request;

        if ($proAtt === null) {
            return null;
        }

        $newArray = [];

        $elements = explode(',', $proAtt);

        foreach ($elements as $element) {
            $parts = explode('-', $element);
            $prefix = $parts[0];
            $value = $parts[1];

            if (!isset($newArray[$prefix])) {
                $newArray[$prefix] = $prefix . '-' . $value;
            } else {

                $newArray[$prefix] .= '-' . $value;
            }
        }

        $newArray = array_values($newArray);

        return $newArray;
    }

    private function getArray($array)
    {
        if ($array) {
            if (count($array) == 1) {
                return $array;
            }
            $newArray = $array[0];
            for ($i = 1; $i < count($array); $i++) {
                $newArray = $this->mergeArray($newArray, $array[$i]);
            }
            return $newArray;
        } else {
            return null;
        }
    }

    private function createAttribute($att, $Name, $adminRole)
    {
        $name = $att[$Name];

        $attribute = Attribute::where('serve', 'shipgo')->where('serve_id', $att['Id'])->first();
        if (!$attribute) {
            $attribute = new Attribute();
            $attribute->name = $name;

            $attribute->serve = 'shipgo';
            $attribute->serve_id = $att['Id'];

            $ld = new TranslateController();

            $attribute->name_vi = $ld->translateText($att[$Name], 'vi');
            $attribute->name_zh = $ld->translateText($att[$Name], 'zh-CN');
            $attribute->name_en = $ld->translateText($att[$Name], 'en');
            $attribute->name_ja = $ld->translateText($att[$Name], 'ja');
            $attribute->name_ko = $ld->translateText($att[$Name], 'ko');

            $attribute->slug = \Str::slug($name);
            $attribute->user_id = $adminRole->user_id;

            $attribute->status = AttributeStatus::ACTIVE;
            $attribute->save();
        }
        return $attribute;
    }

    public function createProperty($property, $name, $itemAttributeProductValue)
    {
        $property->name = $itemAttributeProductValue[$name];

        $property->serve = 'shipgo';
        $property->serve_id = $itemAttributeProductValue['Id'];

        $ld = new TranslateController();

        $property->name_vi = $ld->translateText($itemAttributeProductValue[$name], 'vi');
        $property->name_zh = $ld->translateText($itemAttributeProductValue[$name], 'zh-CN');
        $property->name_en = $ld->translateText($itemAttributeProductValue[$name], 'en');
        $property->name_ja = $ld->translateText($itemAttributeProductValue[$name], 'ja');
        $property->name_ko = $ld->translateText($itemAttributeProductValue[$name], 'ko');

        $property->slug = \Str::slug($itemAttributeProductValue[$name]);


        $property->status = PropertiStatus::ACTIVE;

        $property->save();

        return $property;
    }

    private function createProduct($product, $item)
    {

        $product->name = $item['Name'];

        $language = $this->getLanguageCode((new TranslateController())->detectLanguage($item['Name']));

        $ld = new TranslateController();

        $product->name_vi = $ld->translateText($item['Name'], 'vi');
        $product->name_ja = $ld->translateText($item['Name'], 'ja');
        $product->name_ko = $ld->translateText($item['Name'], 'ko');
        $product->name_en = $ld->translateText($item['Name'], 'en');
        $product->name_zh = $ld->translateText($item['Name'], 'zh-CN');

        $product->description = $item['FullDescription'] ?? 'FullDescription';

//        $product->description_vi = $ld->translateText($item['FullDescription'], 'vi');
//        $product->description_ja = $ld->translateText($item['FullDescription'], 'ja');
//        $product->description_ko = $ld->translateText($item['FullDescription'], 'ko');
//        $product->description_en = $ld->translateText($item['FullDescription'], 'en');
//        $product->description_zh = $ld->translateText($item['FullDescription'], 'zh-CN');

        $product->short_description = $item['ShortDescription'];

//        $product->short_description_vi = $ld->translateText($item['ShortDescription'], 'vi');
//        $product->short_description_ja = $ld->translateText($item['ShortDescription'], 'ja');
//        $product->short_description_ko = $ld->translateText($item['ShortDescription'], 'ko');
//        $product->short_description_en = $ld->translateText($item['ShortDescription'], 'en');
//        $product->short_description_zh = $ld->translateText($item['ShortDescription'], 'zh-CN');

        $product->price = $item['Price'];
        $product->old_price = $item['OldPrice'];
        $product->min = $item['OrderMinimumQuantity'];
        $product->slug = $item['Sku'];

        $product->hot = 0;
        $product->feature = 0;
        $product->views = 0;

        $product->origin = $language;
        $product->location = $language;

        $product->product_code = 'SG-P-' . (new HomeController())->generateRandomString(8);

        $product->status = ProductStatus::ACTIVE;

        $product->save();

        return $product;
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
                } catch (\Exception $exception) {
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

    private function checkServeImage($thumbnail)
    {
        try {
            $shipgo = Contains::SHIP_GO;
            $filename = $shipgo . $thumbnail;
            $image_info = getimagesize($filename);
            if (!$image_info) {
                $localhost44369 = Contains::LOCALHOST_44369;
                $filename = $localhost44369 . $thumbnail;
                $image_info = getimagesize($filename);
                if (!$image_info) {
                    $localhost5001 = Contains::LOCALHOST_5001;
                    $filename = $localhost5001 . $thumbnail;
                }
            }
            return $filename;
        } catch (\Exception $exception) {
            $localhost5001 = Contains::LOCALHOST_5001;
            $filename = $localhost5001 . $thumbnail;
            return $filename;
        }
    }

    private function saveImageToProject($thumbnail)
    {

        try {
            $destinationPath = 'storage/app/public/shipgo/images';
            copy($thumbnail, $destinationPath);
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    // Start call api
    private function getAllCategoryFromShipGo()
    {
        try {
            $url = Contains::URL_GET_ALL_CATEGORY_SHIP_GO;
            $url_local = Contains::URL_GET_ALL_CATEGORY_SHIP_GO_LOCAL;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getProductByCategoryFromShipGo($id)
    {
        try {
            $url = Contains::URL_GET_PRODUCT_BY_CATEGORY_SHIP_GO . '/' . $id;
            $url_local = Contains::URL_GET_PRODUCT_BY_CATEGORY_SHIP_GO_LOCAL . '/' . $id;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getAllProductFromShipGo()
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_ACTIVE;
            $url_local = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_LOCAL_ACTIVE;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getAllProductPictures($productID)
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_PICTURES . '/' . $productID;
            $url_local = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_LOCAL_PICTURES . '/' . $productID;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $pictures = $response->getBody()->getContents();
            return $pictures;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getProductPicture($productID)
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_PICTURE . '/' . $productID;
            $url_local = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_LOCAL_PICTURE . '/' . $productID;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $picture = $response->getBody()->getContents();
            return $picture;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getProductPictureDetail($pictureID)
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_PICTURES_DETAIL . '/' . $pictureID;
            $url_local = Contains::URL_GET_ALL_PRODUCT_SHIP_GO_LOCAL_PICTURES_DETAIL . '/' . $pictureID;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $picture = $response->getBody()->getContents();
            return $picture;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getAllAttributeFromShipGo()
    {
        try {
            $url = Contains::URL_GET_ALL_ATTRIBUTE_SHIP_GO;
            $url_local = Contains::URL_GET_ALL_ATTRIBUTE_SHIP_GO_LOCAL;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getAllProductAttributeFromShipGo($productID)
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_ATTRIBUTE_SHIP_GO . '/' . $productID;
            $url_local = Contains::URL_GET_ALL_PRODUCT_ATTRIBUTE_SHIP_GO_LOCAL . '/' . $productID;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    private function getAllProductAttributeValueFromShipGo($productAttributeID)
    {
        try {
            $url = Contains::URL_GET_ALL_PRODUCT_ATTRIBUTE_VALUE_SHIP_GO . '/' . $productAttributeID;
            $url_local = Contains::URL_GET_ALL_PRODUCT_ATTRIBUTE_VALUE_SHIP_GO_LOCAL . '/' . $productAttributeID;
            $client = new Client(['verify' => false]);
            $response = $client->get($url_local);
            $data = $response->getBody()->getContents();
            return $data;
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
