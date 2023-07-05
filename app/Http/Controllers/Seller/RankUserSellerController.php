<?php

namespace App\Http\Controllers\Seller;

use App\Enums\PromotionStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\RankUserSeller;
use App\Models\Voucher;
use App\Models\VoucherItem;
use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankUserSellerController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $rankSellers = RankUserSeller::where('user_id', Auth::user()->id)->get();
        return view('backend/rankSeller/list', compact('rankSellers'));
    }

    public function processCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        $reflector = new \ReflectionClass('App\Enums\UserInterestEnum');
        $levels = $reflector->getConstants();
        return view('backend/rankSeller/create', compact('levels'));
    }

    public function create(Request $request)
    {
        try {
            $percent = $request->input('percent');
            $code = 'SMRS' . (new Utils())->generateString();
            $arrayIds = $this->getArrayIds($request);
            try {
                $listIDs = implode(',', $arrayIds);
            } catch (\Exception $exception) {
                alert()->error('Error', 'Error, Please choosing your apply!');
                return back();
            }

            $rankSeller = RankUserSeller::where('apply', $listIDs)->first();
            if ($rankSeller){
                alert()->error('Error', 'Error, The apply exited!');
                return back();
            }

            $create = RankUserSeller::create([
                'percent' => $percent,
                'user_id' => Auth::user()->id,
                'code' => $code,
                'apply' => $listIDs,
            ]);
            if ($create) {
                alert()->success('Success', 'Create rank success!');
                return redirect(route('seller.rank.setup.show'));
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
        $rankSeller = RankUserSeller::find($id);
        $reflector = new \ReflectionClass('App\Enums\UserInterestEnum');
        $levels = $reflector->getConstants();
        return view('backend/rankSeller/detail', compact('rankSeller', 'levels'));
    }

    public function update(Request $request, $id)
    {
        try {
            $percent = $request->input('percent');
            $arrayIds = $this->getArrayIds($request);
            $create = RankUserSeller::find($id);
            try {
                $listIDs = implode(',', $arrayIds);
            } catch (\Exception $exception) {
                alert()->error('Error', 'Error, Please choosing your apply!');
                return back();
            }
            $create->percent = $percent;
            $create->apply = $listIDs;
            $success = $create->save();
            if ($success) {
                alert()->success('Success', 'Update rank success!');
                return redirect(route('seller.rank.setup.show'));
            }
            alert()->error('Error', 'Error, Update error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $rankSeller = RankUserSeller::find($id);
            $rankSeller->delete();
            alert()->success('Success', 'Delete rank success!');
            return redirect(route('seller.rank.setup.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    private function getArrayIds(Request $request)
    {
        $listCategoryName[] = null;
        $arrayIds = null;
        $reflector = new \ReflectionClass('App\Enums\UserInterestEnum');
        $levels = $reflector->getConstants();
        foreach ($levels as $level) {
            $name = 'apply-' . $level;
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
        if ($arrayIds == null) {
            alert()->error('Error', 'Error, Please choosing your apply!');
            return back();
        }
        return $arrayIds;
    }
}
