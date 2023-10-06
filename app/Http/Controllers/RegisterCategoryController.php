<?php

namespace App\Http\Controllers;

use App\Enums\AttributeStatus;
use App\Enums\CategoryStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\StorageProduct;
use App\Models\User;
use Doctrine\DBAL\Driver\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterCategoryController extends Controller
{

    public function registerCategory($id, Request $request){
        var_dump($id);
        (new HomeController())->getLocale($request);
        try {
            $registerCate = MemberRegisterPersonSource::where('email', Auth::user()->email)->get();
            $registerCategories = MemberRegisterInfo::where('id', $registerCate[0]['member_id'])->first();
            $arrayCategory = explode(',', $registerCategories['category_id']);
            if (!in_array($id, $arrayCategory)) {
                $arrayCategory[] = $id;
                $cate = implode(',', $arrayCategory);
                $registerCategories->category_id = $cate;
                $registerCategories->save();
            }
            return redirect()->back()->withInput();
        }catch (\Exception $exception){
        $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
    }
}
