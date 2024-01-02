<?php

namespace App\Http\Controllers;

use App\Enums\AttributeStatus;
use App\Enums\CategoryStatus;
use App\Enums\Contains;
use App\Enums\ProductStatus;
use App\Enums\VariationStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Properties;
use App\Models\Role;
use App\Models\Variation;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class InsertProductController extends Controller
{
    public function insertProductFromLazada($keyword)
    {
        $key = null;
        $arrayKeyword = explode('_', $keyword);
        foreach ($arrayKeyword as $item_keyword) {
            if ($key) {
                $key = $key . ' ' . $item_keyword;
            } else {
                $key = $item_keyword;
            }
        }
        try {
            $role = Role::where('name', 'super_admin')->first();
            $adminRole = DB::table('role_user')->where('role_id', $role->id)->first();

            $region = 'VN';
            $page = 1;

            $http = 'https:';
            $serve = 'lazada';

            $ld = new TranslateController();

            $category = Category::where('status', CategoryStatus::ACTIVE)->first();

            $products = $this->callListProductsFromLazada($key, $region, $page);

            if ($products) {
                foreach ($products as $item) {
                    $product = $item->item;

                    $serve_id = $product->itemId;
                    $newProduct = Product::where('serve_id', $serve_id)->where('serve', $serve)->first();
                    if (!$newProduct) {
                        $newProduct = new Product();
                    }

                    $name = $product->title;

                    $thumbnail = $http . $product->image;

                    $arrayGalleries = null;
                    $arrayGalleries = $product->thumbnails;
                    $listGalleries = null;
                    if (is_array($arrayGalleries)) {
                        foreach ($arrayGalleries as $gallery) {
                            $httpImg = $http . $gallery->image;
                            if ($listGalleries) {
                                $listGalleries = $listGalleries . ',' . $httpImg;
                            } else {
                                $listGalleries = $httpImg;
                            }
                        }
                    }

                    $galleryList = $listGalleries;

                    if (!$galleryList){
                        $galleryList = $thumbnail;
                    }

//                    $oldPrice = number_format(convertCurrency('VND', 'USD', $product->sku->def->price), 0, ',', '.');
//                    $price = number_format(convertCurrency('VND', 'USD', $product->sku->def->promotionPrice), 0, ',', '.');

                    $oldPrice = $product->sku->def->price;
                    $price = $product->sku->def->promotionPrice;

                    $detailProduct = $this->callProductFromLazadaByProductID($serve_id, $region);

                    $productSettings = $detailProduct->settings;
                    $productItem = $detailProduct->item;
                    $productService = $detailProduct->service;

                    $newProduct->name = $name;

                    $name_vi = $ld->translateText($name, 'vi');
                    $name_ja = $ld->translateText($name, 'ja');
                    $name_ko = $ld->translateText($name, 'ko');
                    $name_en = $ld->translateText($name, 'en');
                    $name_zh = $ld->translateText($name, 'zh-CN');

                    $newProduct->name_en = $name_en;
                    $newProduct->name_ko = $name_ko;
                    $newProduct->name_ja = $name_ja;
                    $newProduct->name_zh = $name_zh;
                    $newProduct->name_vi = $name_vi;

                    $newProduct->old_price = $oldPrice;
                    $newProduct->price = $price;

                    $newProduct->thumbnail = $thumbnail;
                    $newProduct->gallery = $galleryList;

                    $newProduct->short_description = $name;

                    $short_description_vi = $ld->translateText($name, 'vi');
                    $short_description_ja = $ld->translateText($name, 'ja');
                    $short_description_ko = $ld->translateText($name, 'ko');
                    $short_description_en = $ld->translateText($name, 'en');
                    $short_description_zh = $ld->translateText($name, 'zh-CN');

                    $newProduct->short_description_en = $short_description_en;
                    $newProduct->short_description_ko = $short_description_ko;
                    $newProduct->short_description_ja = $short_description_ja;
                    $newProduct->short_description_zh = $short_description_zh;
                    $newProduct->short_description_vi = $short_description_vi;

                    $newProduct->description = $productItem->description->html;

                    $newProduct->description_en = $productItem->description->html;
                    $newProduct->description_ko = $productItem->description->html;
                    $newProduct->description_ja = $productItem->description->html;
                    $newProduct->description_zh = $productItem->description->html;
                    $newProduct->description_vi = $productItem->description->html;

                    $newProduct->category_id = $category->id;
                    $newProduct->list_category = $category->id;

                    $newProduct->origin = $productSettings->country;
                    $newProduct->location = $productSettings->locale;

                    $newProduct->product_code = 'LZD-P-' . (new HomeController())->generateRandomString(8);

                    $newProduct->min = 1;
                    $newProduct->slug = \Str::slug($name);

                    $newProduct->serve = $serve;
                    $newProduct->serve_id = $serve_id;

                    $newProduct->user_id = $adminRole->user_id;

                    $success = null;
                    if ($galleryList) {
                        $success = $newProduct->save();
                    }

                    if ($success) {
                        $arrayAttributes = $productItem->sku->props;
                        if ($arrayAttributes) {
                            foreach ($arrayAttributes as $attribute) {
                                $newAttribute = Attribute::where('serve', $serve)->where('serve_id', $attribute->pid)->first();
                                if (!$newAttribute) {
                                    $newAttribute = new Attribute();
                                }

                                $newAttribute->serve = $serve;
                                $newAttribute->serve_id = $attribute->pid;
                                $newAttribute->name = $attribute->name;

                                $name_vi = $ld->translateText($attribute->name, 'vi');
                                $name_ja = $ld->translateText($attribute->name, 'ja');
                                $name_ko = $ld->translateText($attribute->name, 'ko');
                                $name_en = $ld->translateText($attribute->name, 'en');
                                $name_zh = $ld->translateText($attribute->name, 'zh-CN');

                                $newAttribute->name_en = $name_en;
                                $newAttribute->name_ko = $name_ko;
                                $newAttribute->name_ja = $name_ja;
                                $newAttribute->name_zh = $name_zh;
                                $newAttribute->name_vi = $name_vi;

                                $newAttribute->user_id = $adminRole->user_id;;

                                $newAttribute->slug = \Str::slug($name);

                                $newAttribute->status = AttributeStatus::ACTIVE;

                                $newAttribute->save();

                                $arrayProperties = $attribute->values;

                                $arrayPropertyIDs = null;
                                foreach ($arrayProperties as $property) {
                                    $newProperty = Properties::where('serve', $serve)->where('serve_id', $property->vid)->first();
                                    if (!$newProperty) {
                                        $newProperty = new Properties();
                                    }

                                    $newProperty->serve = $serve;
                                    $newProperty->serve_id = $property->vid;

                                    $newProperty->name = $property->name;

//                            $name_vi = $ld->translateText($property->name, 'vi');
//                            $name_ja = $ld->translateText($property->name, 'ja');
//                            $name_ko = $ld->translateText($property->name, 'ko');
//                            $name_en = $ld->translateText($property->name, 'en');
//                            $name_zh = $ld->translateText($property->name, 'zh-CN');

                                    $newProperty->name_en = $property->name;
                                    $newProperty->name_ko = $property->name;
                                    $newProperty->name_ja = $property->name;
                                    $newProperty->name_zh = $property->name;
                                    $newProperty->name_vi = $property->name;

                                    $newProperty->status = ProductStatus::ACTIVE;

                                    $newProperty->slug = \Str::slug($name);

                                    $newProperty->attribute_id = $newAttribute->id;
                                    $newProperty->save();

                                    $arrayPropertyIDs[] = $newProperty->id;
                                }

                                $product_attribute = [
                                    'product_id' => $newProduct->id,
                                    'attribute_id' => $newAttribute->id,
                                    'value' => implode(',', $arrayPropertyIDs),
                                    'status' => 'ACTIVE',
                                ];

                                DB::table('product_attribute')->updateOrInsert(
                                    [
                                        'product_id' => $newProduct->id,
                                        'attribute_id' => $newAttribute->id,
                                    ],
                                    $product_attribute
                                );
                            }

                            $arrayVariables = $productItem->sku->base;
                            if ($arrayVariables) {
                                foreach ($arrayVariables as $variable) {
                                    $productMapping = $variable->propMap;
                                    $arrayAttributeProperty = explode(';', $productMapping);
                                    $variItem = null;
                                    foreach ($arrayAttributeProperty as $attribute_property) {
                                        $arrayItem = explode(':', $attribute_property);

                                        $attributeItem = Attribute::where('serve', $serve)->where('serve_id', $arrayItem[0])->first();
                                        $propertyItem = Properties::where('serve', $serve)->where('serve_id', $arrayItem[1])->first();

                                        if ($attributeItem && $propertyItem) {
                                            $att_pro = $attributeItem->id . '-' . $propertyItem->id;

                                            if ($variItem) {
                                                $variItem = $variItem . ',' . $att_pro;
                                            } else {
                                                $variItem = $att_pro;
                                            }
                                        } else {
                                            $variItem = '';
                                        }
                                    }

                                    $variation = Variation::where('product_id', $newProduct->id)
                                        ->where('variation', $variItem)
                                        ->first();
                                    if (!$variation) {
                                        $variation = new Variation();

                                        $variation->product_id = $newProduct->id;
                                        $variation->user_id = $adminRole->user_id;

                                        $variation->variation = $variItem;
                                    }

                                    $variation->quantity = $variable->quantity;

//                                $variation->price = number_format(convertCurrency('VND', 'USD', $variable->promotionPrice), 0, ',', '.');
//                                $variation->old_price = number_format(convertCurrency('VND', 'USD', $variable->promotionPrice), 0, ',', '.');
                                    $variation->price = $variable->promotionPrice;
                                    $variation->old_price = $variable->promotionPrice;

                                    $variation->description = $newProduct->description;

                                    $variation->thumbnail = $newProduct->thumbnail;

                                    $variation->status = VariationStatus::ACTIVE;

                                    $variation->save();
                                }
                            }
                        }
                    }
                }
                return "insert success!";
            }
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    private function callListProductsFromLazada($key, $region, $page)
    {
        $url = 'https://lazada-datahub.p.rapidapi.com/item_search?q=' . $key . '&region=' . $region . '&page=' . $page;
        $result = $this->callApiFromLazada($url);

        if ($result->result) {
            $products = $result->result->resultList;
            return $products;
        }
        return null;
    }

    private function callApiFromLazada($url)
    {
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'X-RapidAPI-Host' => 'lazada-datahub.p.rapidapi.com',
                'X-RapidAPI-Key' => Contains::KEY_LAZADA,
            ],
        ]);

        $data = $response->getBody()->getContents();
        $result = json_decode($data);
        return $result;
    }

    private function callProductFromLazadaByProductID($productID, $region)
    {
        $url = 'https://lazada-datahub.p.rapidapi.com/item_detail_2?itemId=' . $productID . '&region=' . $region;
        $result = $this->callApiFromLazada($url);

        $product = $result->result;
        return $product;
    }
}
