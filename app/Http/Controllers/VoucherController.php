<?php

namespace App\Http\Controllers;

use App\Enums\PromotionStatus;
use App\Enums\UserInterestEnum;
use App\Enums\UserStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
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
        $products = $this->mergeDuplicate($request);
        if (count($products) < 1) {
            alert()->error('Error', 'Không có sản phẩm phù hợp!');
            return redirect(route('seller.vouchers.list'));
        }
        $reflector = new \ReflectionClass('App\Enums\UserInterestEnum');
        $levels = $reflector->getConstants();
        return view('backend/voucher/create', compact('products', 'levels'));
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
            $assign_to = $request->input('assign_to');

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
                'assign_to' => $assign_to,
            ];

            $create = Voucher::create($voucher);
            $newVoucher = Voucher::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit(1)->get();
//            if ($assign_to == UserInterestEnum::FREE) {
//                $this->voucherItems($newVoucher[0], UserInterestEnum::FREE);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::VIP);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::VVIP);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::VIP) {
//                $this->voucherItems($newVoucher[0], UserInterestEnum::VIP);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::VVIP);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::VVIP) {
//                $this->voucherItems($newVoucher[0], UserInterestEnum::VVIP);
//                $this->voucherItems($newVoucher[0], UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::SVIP) {
//                $this->voucherItems($newVoucher[0], UserInterestEnum::SVIP);
//            }
            if ($create) {
                alert()->success('Success', 'Create voucher success!');
                return redirect(route('seller.vouchers.list'));
            }
            alert()->error('Error', 'Error, Create error!');
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
        $products = $this->mergeDuplicate($request);
        if (count($products) < 1) {
            alert()->error('Error', 'Không có sản phẩm phù hợp!');
            return redirect(route('seller.vouchers.list'));
        }
        $reflector = new \ReflectionClass('App\Enums\UserInterestEnum');
        $levels = $reflector->getConstants();
        return view('backend/voucher/detail', compact('products', 'voucher', 'levels'));
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
            $assign_to = $request->input('assign_to');
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
            $voucher->assign_to = $assign_to;
            $voucher->save();

//            $oldVoucherItemsn = VoucherItem::where([
//                ['voucher_id', $voucher->id],
//                ['checked', 1],
//            ])->delete();
//
//            if ($assign_to == UserInterestEnum::FREE) {
//                $this->voucherItems($voucher, UserInterestEnum::FREE);
//                $this->voucherItems($voucher, UserInterestEnum::VIP);
//                $this->voucherItems($voucher, UserInterestEnum::VVIP);
//                $this->voucherItems($voucher, UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::VIP) {
//                $this->voucherItems($voucher, UserInterestEnum::VIP);
//                $this->voucherItems($voucher, UserInterestEnum::VVIP);
//                $this->voucherItems($voucher, UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::VVIP) {
//                $this->voucherItems($voucher, UserInterestEnum::VVIP);
//                $this->voucherItems($voucher, UserInterestEnum::SVIP);
//            } elseif ($assign_to == UserInterestEnum::SVIP) {
//                $this->voucherItems($voucher, UserInterestEnum::SVIP);
//            }

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

    private function mergeDuplicate(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        $vouchers = Promotion::where([['user_id', Auth::user()->id], ['status', '!=', PromotionStatus::DELETED]])->get();
        $myArray = null;
        foreach ($products as $product) {
            $myArray[] = $product->id;
        }
        $arrayIDs = [];
        foreach ($vouchers as $voucher) {
            $listIDs = $voucher->apply;
            $arrayIDs = explode(',', $listIDs);
        }
        return array_diff($myArray, $arrayIDs);
    }

    private function voucherItems($newVoucher, $status)
    {
        $users = User::where([
            ['status', UserStatus::ACTIVE],
            ['level_account', $status]
        ])->get();
        foreach ($users as $user) {
            VoucherItem::create([
                'voucher_id' => $newVoucher->id,
                'customer_id' => $user->id,
                'quantity' => 1,
                'checked' => 1,
            ]);
        }
    }
}
