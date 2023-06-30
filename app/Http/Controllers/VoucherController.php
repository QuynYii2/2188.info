<?php

namespace App\Http\Controllers;

use App\Enums\VoucherStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\VoucherItem;
use App\Services\Utils;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function getListSeller(Request $request)
    {
        (new HomeController())->getLocale($request);
        $vouchers = Voucher::where([
            ['user_id', Auth::user()->id],
            ['status', '!=', VoucherStatus::DELETED]
        ])->get();
        foreach ($vouchers as $voucher) {
            if ($voucher->endDate < Carbon::now()->addHours(7)) {
                $voucher->status = VoucherStatus::INACTIVE;
                $voucher->save();
            }
        }
        return view('backend/voucher/list', compact('vouchers'));
    }

    public function processCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('backend/voucher/create', compact('products'));
    }

    public function create(Request $request)
    {
        try {
            $nameVoucher = $request->input('nameVoucher');
            $quantity = $request->input('quantity');
            $percent = $request->input('percent');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $description = $request->input('description');
            $code = 'SMV' . (new Utils())->generateString();
            $status = $request->input('status');

            $arrayIds = $this->getArrayIds($request);

            $voucher = [
                'name' => $nameVoucher,
                'quantity' => $quantity,
                'percent' => $percent,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'description' => $description,
                'code' => $code,
                'user_id' => Auth::user()->id,
                'status' => $status,
                'apply' => implode(',', $arrayIds),
            ];

            $create = Voucher::create($voucher);
            if ($create) {
                alert()->success('Success', 'Create voucher success!');
                return redirect(route('seller.vouchers.list'));
            }
            alert()->error('Error', 'Error, Please try again!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function detail(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $voucher = Voucher::find($id);
        if ($voucher->status == VoucherStatus::DELETED) {
            return back();
        }
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('backend/voucher/detail', compact('products', 'voucher'));
    }

    public function update(Request $request, $id)
    {
        try {
            $nameVoucher = $request->input('nameVoucher');
            $quantity = $request->input('quantity');
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

            $voucher = Voucher::find($id);
            if ($voucher->status == VoucherStatus::DELETED) {
                return back();
            }

            $voucher->name = $nameVoucher;
            $voucher->quantity = $quantity;
            $voucher->percent = $percent;
            $voucher->startDate = $startDate;
            $voucher->endDate = $endDate;
            $voucher->description = $description;
            $voucher->status = $status;
            $voucher->apply = $arrayIds;
            $voucher->save();
            alert()->success('Success', 'Update voucher success!');
            return redirect(route('seller.vouchers.list'));

        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function delete($id)
    {
        $voucher = Voucher::find($id);
        if ($voucher->status == VoucherStatus::DELETED) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
        VoucherItem::where('voucher_id', $id)->delete();
        $voucher->status = VoucherStatus::DELETED;
        $voucher->save();
        alert()->success('Success', 'Delete voucher success!');
        return redirect(route('seller.vouchers.list'));
    }

    public function createVoucherItems(Request $request)
    {
        try {
            $voucherID = $request->input('voucher_id');
            $voucherItemOld = VoucherItem::where([['voucher_id', $voucherID], ['customer_id', Auth::user()->id]])->first();
            if ($voucherItemOld) {
                return "Error";
            }
            $customerID = Auth::user()->id;
            if ($voucherID == null) {
                return "Error";
            }
            $item = [
                'voucher_id' => $voucherID,
                'customer_id' => $customerID,
                'quantity' => 1
            ];
            $voucherItem = VoucherItem::create($item);
            $voucher = Voucher::find($voucherID);
            $voucher->quantity = $voucher->quantity - 1;
            $voucher->save();
            if ($voucher->quantity == 0 || $voucher->endDate < Carbon::now()->addHours(7)) {
                $voucher->status = VoucherStatus::INACTIVE;
                $voucher->save();
            }
            if ($voucherItem) {
                return $voucherItem;
            }
            return "Error";
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    private function getArrayIds(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
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
}
