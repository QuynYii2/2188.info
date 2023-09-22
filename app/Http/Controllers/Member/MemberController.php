<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function detailCompany()
    {
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::find($memberPerson->member_id);
        return view('frontend.pages.member.detail-company', compact('company'));
    }

    public function updateCompany(Request $request)
    {
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::find($memberPerson->member_id);

        $memberID = $request->input('member_id');

        $address = $request->input('wards-select') . ', ' . $request->input('provinces-select') . ', ' . $request->input('cities-select') . ', ' . $request->input('countries-select');
        $companyName = $request->input('name_en');
        $numberBusiness = $request->input('number_business');
        $phoneNumber = $request->input('phone');
        $fax = $request->input('fax');
        if (!$fax) {
            $fax = 'default';
        }
        $registerMember = $request->input('member');

        $number_clearance = $request->input('number_clearance');
        $name_en = $request->input('name_en');
        $name_kr = $request->input('name_kr');
        $address_en = $request->input('address_en');
        $address_kr = $request->input('address_kr');
        //file
        if ($request->hasFile('certify_business')) {
            $gpkd = $request->file('certify_business');
            $certify_business = $gpkd->store('certify_business', 'public');
        } else {
            $certify_business = '';
        }

        $status_business = $request->input('status_business');
        $code_1 = $request->input('code_1');
        $code_2 = $request->input('code_2');
        $code_3 = $request->input('code_3');
        $code_4 = $request->input('code_4');


        if ($request->hasFile('giay_phep_kinh_doanh')) {
            $gpkd = $request->file('giay_phep_kinh_doanh');
            $gpkdPath = $gpkd->store('giay_phep_kinh_doanh', 'public');
        } else {
            $gpkdPath = $company->giay_phep_kinh_doanh;
        }

        $arrayIds = $this->getArrayIds($request, 'category-');
        if ($arrayIds) {
            try {
                $categories = implode(',', $arrayIds);
            } catch (\Exception $exception) {
                alert()->error('Error', 'Error, Please choosing your apply category!');
                return back();
            }
        } else {
            alert()->error('Error', 'Error, Please choosing your apply category!');
            return back();
        }

        $codeBusiness = $categories;

        $arrayIds = $this->getArrayIds($request, 'type_business-');
        if ($arrayIds) {
            try {
                $type_business = implode(',', $arrayIds);
            } catch (\Exception $exception) {
                alert()->error('Error', 'Error, Please choosing your apply!');
                return back();
            }
        } else {
            alert()->error('Error', 'Error, Please choosing your apply!');
            return back();
        }

        $company->user_id = Auth::user()->id;
        $company->name = $companyName;
        $company->phone = $phoneNumber;
        $company->category_id = $categories;
        $company->number_business = $numberBusiness;
        $company->type_business = $type_business;
        $company->code_business = $codeBusiness;
        $company->giay_phep_kinh_doanh = $gpkdPath;
        $company->address = $address;
        $company->member_id = $memberID;
        $company->member = $registerMember;

        $company->number_clearance = $number_clearance;
        $company->name_en = $name_en;
        $company->fax = $fax;
        $company->name_kr = $name_kr;
        $company->address_en = $address_en;
        $company->address_kr = $address_kr;
        $company->certify_business = $certify_business;
        $company->status_business = $status_business;
        $company->code_1 = $code_1;
        $company->code_2 = $code_2;
        $company->code_3 = $code_3;
        $company->code_4 = $code_4;

        $success = $company->save();
        return redirect(route('member.detail.company', $company->id));
    }
}
