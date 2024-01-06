<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateCompanyController extends Controller
{

    public function processCreateCompany()
    {
        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();
        $exitsMember = null;
        return view('admin.user-manager.register-member.create-company', compact('categories_no_parent', 'exitsMember'));
    }

    public function createCompany(Request $request)
    {
        try {


            alert()->success('Success', 'Create success!');
            return redirect(route('admin.list.users'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function processCreateUserPerson()
    {
        return view('admin.user-manager.register-member.create-user-person');
    }

    public function processCreateUserRepresent()
    {
        return view('admin.user-manager.register-member.create-user-represent');
    }
}
