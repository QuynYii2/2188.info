<?php

namespace App\Http\Controllers;

use App\Enums\MemberPartnerStatus;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPartnerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $company = MemberRegisterInfo::where('user_id', Auth::user()->id)->first();
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
}
