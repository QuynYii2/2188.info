<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\RankSetUpSeller;
use App\Models\RankUserSeller;
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
        $reflector = new \ReflectionClass('App\Enums\RankSetupSeller');
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
            if ($rankSeller) {
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
        $reflector = new \ReflectionClass('App\Enums\RankSetupSeller');
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

    public function indexSetup(Request $request)
    {
        (new HomeController())->getLocale($request);
        $rankSetups = RankSetUpSeller::where('user_id', Auth::user()->id)->get();
        return view('backend/rankSeller/setup/list', compact('rankSetups'));
    }

    public function processSetupCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('backend/rankSeller/setup/create');
    }

    public function createSetup(Request $request)
    {
        try {
            $copper_price = $request->input('copper_price');
            $silver_price = $request->input('silver_price');
            $gold_price = $request->input('gold_price');
            $diamond_price = $request->input('diamond_price');

            if ($copper_price > $silver_price || $copper_price > $gold_price || $copper_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The copper price unable to be bigger to silver price or gold price or diamond price!');
                return back();
            }

            if ($silver_price > $gold_price || $silver_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The silver price unable to be bigger to gold price or diamond price!');
                return back();
            }

            if ($gold_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The gold price unable to be bigger to diamond price!');
                return back();
            }

            $readNow = "COPPER: " . $copper_price . ", SILVER: " . $silver_price . ", GOLD: " . $gold_price . ", DIAMOND: " . $diamond_price;

            $old = RankSetUpSeller::where('user_id', Auth::user()->id)->first();
            $check = null;
            if ($old) {
                $old->setup = $readNow;
                $update = $old->save();
                $check = 0;
            } else {
                $create = RankSetUpSeller::create([
                    'user_id' => Auth::user()->id,
                    'setup' => $readNow,
                ]);
                $check = 1;
            }
            if ($check == 1) {
                alert()->success('Success', 'Create rank success!');
                return redirect(route('seller.setup.show'));
            } elseif ($check == 0) {
                alert()->success('Success', 'Update rank success!');
                return redirect(route('seller.setup.show'));
            }

            alert()->error('Error', 'Error, Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function detailSetup(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $rankSetup = RankSetUpSeller::where('id', $id)->first();
        $myList = $rankSetup->setup;
        $myArray = explode(',', $myList);
        return view('backend/rankSeller/setup/detail', compact('rankSetup', 'myArray'));
    }

    public function updateSetUp(Request $request, $id)
    {
        try {
            $copper_price = $request->input('COPPER_price');
            $silver_price = $request->input('SILVER_price');
            $gold_price = $request->input('GOLD_price');
            $diamond_price = $request->input('DIAMOND_price');

            if ($copper_price > $silver_price || $copper_price > $gold_price || $copper_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The copper price unable to be bigger to silver price or gold price or diamond price!');
                return back();
            }

            if ($silver_price > $gold_price || $silver_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The silver price unable to be bigger to gold price or diamond price!');
                return back();
            }

            if ($gold_price > $diamond_price) {
                alert()->error('Error', 'Create Fail, The gold price unable to be bigger to diamond price!');
                return back();
            }

            $readNow = "COPPER: " . $copper_price . ", SILVER: " . $silver_price . ", GOLD: " . $gold_price . ", DIAMOND: " . $diamond_price;

            $old = RankSetUpSeller::where('id', $id)->first();

            $old->setup = $readNow;
            $update = $old->save();

            if ($update) {
                alert()->success('Success', 'Success, Update success!');
                return redirect(route('seller.setup.show'));
            }

            alert()->error('Error', 'Error, Update error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    private function getArrayIds(Request $request)
    {
        $listCategoryName[] = null;
        $arrayIds = null;
        $reflector = new \ReflectionClass('App\Enums\RankSetupSeller');
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
