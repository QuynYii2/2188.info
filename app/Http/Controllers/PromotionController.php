<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionItems;
use App\Models\Voucher;
use App\Services\Utils;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function getList(Request $request)
    {
        (new HomeController())->getLocale($request);
        $promotions = Promotion::where([['user_id', Auth::user()->id], ['status', '!=', PromotionStatus::DELETED]])->get();
        return view('backend/promotion/list', compact('promotions'));
    }

    public function detail(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $promotion = Promotion::where('id', $id)->first();
        if ($promotion == null || $promotion->status == PromotionStatus::DELETED) {
            alert()->error('Error', 'Error, No promotion match found, try again!');
            return back();
        }
        $products = $this->mergeDuplicate($request);
        if (count($products) < 1) {
            alert()->error('Error', 'Không có sản phẩm phù hợp!');
            return redirect(route('seller.promotion.list'));
        }
        return view('backend/promotion/detail', compact('promotion', 'products'));
    }

    public function update(Request $request, $id)
    {
        try {
            $name = $request->input('name');
            $percent = $request->input('percent');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $description = $request->input('description');
            $status = $request->input('status');
            $arrayIds = $this->getArrayIds($request);
            if ($arrayIds == null) {
                alert()->error('Error', 'Error, Please enter the apply!');
                return back();
            }
            $arrayIds = implode(',', $arrayIds);

            $promotion = Promotion::find($id);
            if ($promotion->status == PromotionStatus::DELETED) {
                return back();
            }

            $promotion->name = $name;
            $promotion->percent = $percent;
            $promotion->startDate = $startDate;
            $promotion->endDate = $endDate;
            $promotion->description = $description;
            $promotion->status = $status;
            $promotion->apply = $arrayIds;
            $promotion->save();
            alert()->success('Success', 'Update promotion success!');
            return redirect(route('seller.promotion.list'));

        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again later!');
            return back();
        }
    }

    public function processCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        $products = $this->mergeDuplicate($request);
        if ($products) {
            if (count($products) < 1) {
                alert()->error('Error', 'Không có sản phẩm phù hợp!');
                return redirect(route('seller.promotion.list'));
            }
        }
        return view('backend/promotion/create', compact('products'));
    }

    public function create(Request $request)
    {
        try {
            $name = $request->input('name');
            $percent = $request->input('percent');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $description = $request->input('description');
            $code = 'SMP' . (new Utils())->generateString();
            $status = $request->input('status');

            $arrayIds = $this->getArrayIds($request);

            $promotion = [
                'name' => $name,
                'percent' => $percent,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'description' => $description,
                'code' => $code,
                'user_id' => Auth::user()->id,
                'status' => $status,
                'apply' => implode(',', $arrayIds),
            ];

            $create = Promotion::create($promotion);
            if ($create) {
                alert()->success('Success', 'Create promotion success!');
                return redirect(route('seller.promotion.list'));
            }
            alert()->error('Error', 'Error, Create error, try again!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function delete($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion->status == PromotionStatus::DELETED) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
        PromotionItems::where('promotion_id', $id)->delete();
        $promotion->status = PromotionStatus::DELETED;
        $promotion->save();
        alert()->success('Success', 'Delete promotion success!');
        return redirect(route('seller.promotion.list'));
    }

    private function mergeDuplicate(Request $request)
    {
        $isAdmin = (new HomeController())->checkAdmin();
        if ($isAdmin) {
            $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
        } else {
            $products = Product::where([['user_id', Auth::user()->id], ['status', '!=', ProductStatus::DELETED]])->get();
        }
        $vouchers = Voucher::where([['user_id', Auth::user()->id], ['status', '!=', VoucherStatus::DELETED]])->get();
        $myArray = null;
        foreach ($products as $product) {
            $myArray[] = $product->id;
        }
        $arrayIDs = null;
        $items = null;
        if ($myArray) {
            foreach ($vouchers as $voucher) {
                $listIDs = $voucher->apply;
                $arrayIDs = explode(',', $listIDs);
            }
            if ($arrayIDs) {
                $items = array_diff($myArray, $arrayIDs);
            } else {
                $items = $myArray;
            }
        }
        return $items;
    }

    private function getArrayIds(Request $request)
    {
        $isAdmin = (new HomeController())->checkAdmin();
        if ($isAdmin) {
            $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
        } else {
            $products = Product::where([['user_id', Auth::user()->id], ['status', '!=', ProductStatus::DELETED]])->get();
        }
        $listCategoryName[] = null;
        $arrayIds = null;
        foreach ($products as $category) {
            $name = 'category-' . $category->id;
            $listCategoryName[] = $name;
        }
        if ($listCategoryName != null) {
            $listValues = null;
            for ($i = 0; $i < count($listCategoryName); $i++) {
                $listValues[] = $request->input($listCategoryName[$i]);
            }
            if ($listValues != null) {
                for ($i = 1; $i < count($listValues); $i++) {
                    if ($listValues[$i] != null) {
                        $arrayIds[] = $listValues[$i];
                    }
                }
            }
        }
        return $arrayIds;
    }

    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $promotions = Promotion::where('status', '=', PromotionStatus::ACTIVE)->get();
        $promotionIDs = null;
        foreach ($promotions as $promotion) {
            $promotionIDs[] = $promotion->id . '-' . $promotion->user_id;
        }
        return view('frontend/pages/promotions', compact('promotions', 'promotionIDs'));
    }

    public function createPromotionItems(Request $request)
    {
        try {
            $promotionID = $request->input('promotion_id');
            $promotionItemOld = PromotionItems::where([['promotion_id', $promotionID], ['customer_id', Auth::user()->id]])->first();
            if ($promotionItemOld) {
                return "Error";
            }
            $customerID = Auth::user()->id;
            if ($promotionID == null) {
                return "Error";
            }
            $item = [
                'promotion_id' => $promotionID,
                'customer_id' => $customerID
            ];
            $promotionItem = PromotionItems::create($item);
            $promotion = Promotion::find($promotionID);
            $promotion->save();
            if ($promotionItem) {
                return $promotionItem;
            }
            return "Error";
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
