<?php

namespace App\Http\Controllers;

use App\Enums\MemberPartnerStatus;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPartnerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
            $oldItem = MemberPartner::where([
                ['company_id_source', $request->input('company_id_source')],
                ['company_id_follow', $company->id],
                ['status', MemberPartnerStatus::ACTIVE],
            ])->first();
            if ($oldItem) {
                $oldItem->quantity = $oldItem->quantity + 1;
                $oldItem->price = $oldItem->price + $request->input('price');
                $success = $oldItem->save();
            } else {
                $item = [
                    'company_id_source' => $request->input('company_id_source'),
                    'company_id_follow' => $company->id,
                    'quantity' => 1,
                    'price' => 0,
                ];
                $success = MemberPartner::create($item);
            }
            if ($success) {
                alert()->success('Success', 'Success!');
                return back();
            }
            alert()->error('Error', 'Error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
    public function delete(Request $request, $id) {
        try {
            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            $company = MemberRegisterInfo::find($memberPerson->member_id);

            $affectedRows = MemberPartner::where([
                ['company_id_source', $request->input('company_id_source')],
                ['company_id_follow', $company->id],
                ['status', MemberPartnerStatus::ACTIVE],
            ])->delete();

            if ($affectedRows > 0) {
                alert()->success('Success', 'Success!');
                return back();
            } else {
                alert()->error('Error', 'Error!');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
//        try {
//            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
//            $company = MemberRegisterInfo::find($memberPerson->member_id)->first();
//
//            $affectedRows = MemberPartner::where([
//                ['company_id_source', $_POST['company_id_source']],
//                ['company_id_follow', $company->id],
//                ['status', MemberPartnerStatus::ACTIVE],
//            ])->update(['status' => MemberPartnerStatus::INACTIVE]); // Cập nhật trạng thái
//            if ($affectedRows > 0) {
//                alert()->success('Success', 'Unfollowed successfully!');
//                return back();
//            } else {
//                alert()->error('Error', 'Unfollow failed!');
//                return back();
//            }
//        } catch (\Exception $exception) {
//            alert()->error('Error', 'Error, Please try again!');
//            return back();
//        }
    }

}
