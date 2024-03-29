<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\EvaluateProductStatus;
use App\Enums\ProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Product;
use App\Models\ShopInfo;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopInformationController extends Controller
{

    public function index($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $listProduct = Product::where('status', ProductStatus::ACTIVE)
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $countProductBySeller = Product::selectRaw('COUNT(*) as countProduct')
            ->where('user_id', '=', $id)
            ->first();

        $listVouchers = Voucher::where('user_id', '=', $id)->get();
        $user = User::find($id);
        $memberPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
        $company = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
        }
        /* Find category */
        $category_id = $company->category_id;
        $arrayCategory = explode(',', $category_id);
        $categories = Category::whereIn('id', $arrayCategory)->where('status', CategoryStatus::ACTIVE)->get();
        /* Convert currency*/
        $currency = (new HomeController())->getLocation($request);
        /* Calc average rate */
        $evaluates = DB::table('evaluate_products')
            ->join('products', 'products.id', '=', 'evaluate_products.product_id')
            ->where('products.user_id', $id)
            ->where('evaluate_products.status', '!=', EvaluateProductStatus::DELETED)
            ->select('evaluate_products.star_number')
            ->get();
        $totalRatings = $evaluates->count();
        $totalStars = 0;
        foreach ($evaluates as $evaluate) {
            $totalStars += $evaluate->star_number;
        }
        $averageRating = $totalRatings > 0 ? $totalStars / $totalRatings : 0;
        $averageRatingsFormatted = number_format($averageRating, 2);
        return view('frontend/pages/shop-information/index', compact(
            'listProduct',
            'company',
            'countProductBySeller',
            'listVouchers',
            'currency',
            'categories',
            'memberPerson',
            'user',
            'averageRatingsFormatted',
            'totalRatings'));
    }


    public function filterProductBySeller(Request $request, $id)
    {
        $sortArr = explode(' ', $request->data['sortBy']);
        $selectedPayments = $request->data['selectedPayments'];
        $selectedTransports = $request->data['selectedTransports'];
        $search_origin = $request->data['search_origin'];
        $minPrice = $request->data['minPrice'];
        $maxPrice = $request->data['maxPrice'];
        $isSale = $request->data['isSale'];

        $query = Product::select('products.*', 'users.payment_method', 'users.transport_method')
            ->where([['products.status', '=', ProductStatus::ACTIVE], ['user_id', '=', $id]])
            ->join('users', 'products.user_id', '=', 'users.id');

        $selectedPaymentsArray = [];
        foreach ($selectedPayments as $payment) {
            $selectedPaymentsArray = array_merge($selectedPaymentsArray, explode(',', $payment));
        }

        $selectedPaymentsArray = array_unique($selectedPaymentsArray);

        if ($search_origin) {
            $query->where('products.origin', 'LIKE', '%' . $search_origin . '%');
        }

        if (count($selectedPaymentsArray) > 1) {
            $query->where(function ($query) use ($selectedPaymentsArray) {
                foreach ($selectedPaymentsArray as $payment) {
                    $query->orWhere('users.payment_method', 'LIKE', '%' . $payment . '%');
                }
            });
        }

        $selectedTransportsArray = [];
        foreach ($selectedTransports as $transport) {
            $selectedTransportsArray = array_merge($selectedTransportsArray, explode(',', $transport));
        }

        $selectedTransportsArray = array_unique($selectedTransportsArray);

        if (count($selectedTransportsArray) > 1) {
            $query->where(function ($query) use ($selectedTransportsArray) {
                foreach ($selectedTransportsArray as $transport) {
                    $query->orWhere('users.transport_method', 'LIKE', '%' . $transport . '%');
                }
            });
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('products.price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('products.price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('products.price', '<=', $maxPrice);
        }

        if ($isSale == 'true') {
            $query->whereNotNull('products.old_price');
        }

        $listProduct = $query->orderBy('products.' . $sortArr[0], $sortArr[1])
            ->paginate($request->data['countPerPage']);

        return response()->json($this->renderDataToHTML($listProduct));
    }

    public function renderDataToHTML($listProduct)
    {
        $str = '';
        foreach ($listProduct as $product) {
            $str .= '<div class="col-xl-3 col-md-4 col-6 section">
            <div class="item">
                <div class="item-img">
                    <img src="' . asset('storage/' . $product['thumbnail']) . '" alt="">
                    <div class="button-view">
                        <button class="quickView" onclick="clickImage(' . $product['id'] . ');" data-value="' . $product['id'] . '">Quick view</button>
                    </div>
                    <div class="text">
                        <div class="text-sale">
                            Sale
                        </div>
                        <div class="text-new">
                            New
                        </div>
                    </div>
                </div>
                <input type="text" id="productThumbnail' . $product['id'] . '" class="d-none" value="' . $product['thumbnail'] . '">
                <input type="text" id="productGallery' . $product['id'] . '" class="d-none" value="' . $product['gallery'] . '">
                <div class="item-body">
                    <div class="card-title1">
                        <a href="' . route('detail_product.show', $product['id']) . '">' . $product['name'] . '</a>
                    </div>
                    <div class="card-price">
                        <div class="price-sale">
                            <strong>' . $product['price'] . '</strong>
                        </div>
                        <div class="price-cost">';
            if ($product['old_price'] != null) {
                $str .= '<strike>' . $product['old_price'] . '</strike>';
            }
            $str .= '</div>
                    </div>
                    <div class="card-bottom d-flex justify-content-between">
                        <div class="card-bottom--left">
                            <a href="' . route('detail_product.show', $product['id']) . '">Choose Options</a>
                        </div>
                        <div class="card-bottom--right">
                            <i class="item-icon fa-regular fa-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        };
        return $str;
    }

    public function productByShop(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where([
            ['status', ProductStatus::ACTIVE],
            ['user_id', $id]
        ])->get();
        return view('frontend.pages.shop-information.product-shop', compact('products'));
    }


    public function store(Request $request)
    {
        try {
            $shopinformation = new ShopInfo();
            $shopinformation->user_id = Auth::user()->id;
            $shopinformation->name = $request->input('name');
            $shopinformation->country = $request->input('region');
            $shopinformation->masothue = $request->input('masothue');
            $shopinformation->product_name = $request->input('product_name');
            $shopinformation->product_code = $request->input('product_code');
            $shopinformation->product_key = $request->input('product_key');
            $shopinformation->information = $request->input('information');
            $shopinformation->business_license = $request->input('business_license');
            $shopinformation->acreage = $request->input('acreage');
            $shopinformation->industry_year = $request->input('industry_year');
            $shopinformation->machine_number = $request->input('machine_number');
            $shopinformation->marketing = $request->input('marketing');
            $shopinformation->customers = $request->input('customers');
            $shopinformation->inspection_staff = $request->input('inspection_staff');
            $shopinformation->test_method = $request->input('test_method');
            $shopinformation->annual_output = $request->input('annual_output');
            $shopinformation->partner = $request->input('partner');
            $Shop = $shopinformation->save();
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfileShop(Request $request, $id)
    {
        $shopinformation = ShopInformation::findOrFail($id);
        $shopinformation->user_id = Auth::user()->id;
        $shopinformation->name = $request->input('name');
        $shopinformation->country = $request->input('region');
        $shopinformation->masothue = $request->input('masothue');
        $shopinformation->product_name = $request->input('product_name');
        $shopinformation->product_code = $request->input('product_code');
        $shopinformation->product_key = $request->input('product_key');
        $shopinformation->information = $request->input('information');
        $shopinformation->business_license = $request->input('business_license');
        $shopinformation->acreage = $request->input('acreage');
        $shopinformation->industry_year = $request->input('industry_year');
        $shopinformation->machine_number = $request->input('machine_number');
        $shopinformation->marketing = $request->input('marketing');
        $shopinformation->customers = $request->input('customers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
