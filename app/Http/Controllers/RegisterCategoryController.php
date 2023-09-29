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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterCategoryController extends Controller
{

    public function index(){
        $user = Auth::user()->id;
        view('backend\register_categories\register_form',
        [
            'user' => $user,
            ]);
    }
    //
    public function registerProcess(Request $request){
        (new HomeController())->getLocale($request);
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        $registerCate = MemberRegisterPersonSource::where('email', Auth::user()->email)->get();
        $registerCategories = MemberRegisterInfo::where('id', $registerCate[0]['member_id'])->get();
        $categoriesRegister =[];
        $arrayCategory = explode(',', $registerCategories[0]['category_id']);
        foreach($arrayCategory as $registerCategor){
            array_push($categoriesRegister, $registerCategor);
        }

        $id = Auth::user()->id;
        $roles = DB::table('role_user')->where('user_id', $id)->get('role_id');
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        foreach ($roles as $role) {
            if ($role->role_id == 1) {
                $storages = StorageProduct::all();
                break;
            }
        }

        return view('backend\register_categories\register_form',
        [
            'categories' => $categories,
            'storages' => $storages,
            'categoriesRegister' => $categoriesRegister,
        ]);
    }

    public function registerCategory(){

    }
}
