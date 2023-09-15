<?php

namespace App\Http\Controllers;

use App\Enums\MemberPartnerStatus;
use App\Enums\RegisterMember;
use App\Models\Chat;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;

class SampleController extends Controller
{
    public function chat(Request $request)
    {
        $memberPerson = \App\Models\MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $isMember = null;
        if ($memberPerson){
            $company = \App\Models\MemberRegisterInfo::where([
                ['id', $memberPerson->member_id],
                ['status', \App\Enums\MemberRegisterInfoStatus::ACTIVE]
            ])->first();
        }
        $homeController = new HomeController();
        $this->locale = $homeController->getLocale($request);
        return view('frontend.pages.message.chat')->with('company', $company);
    }

    public function getListMessageSent(Request $request)
    {
        $homeController = new HomeController();
        $this->locale = $homeController->getLocale($request);
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
        }
        $listMessage = Chat::where('from_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);

        $collection = $listMessage;

        $listMessage = $collection->groupBy('to_user_id')->map(function ($group) {
            return $group->first();
        })->values();

        return view('frontend.pages.message.message-sent', compact('listMessage', 'company'));
    }

    public function getListMessageReceived(Request $request)
    {
        $homeController = new HomeController();
        $this->locale = $homeController->getLocale($request);
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
        }
        $listMessage = Chat::where('to_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);

        $collection = $listMessage;

        $listMessage = $collection->groupBy('from_user_id')->map(function ($group) {
            return $group->first();
        })->values();

        return view('frontend.pages.message.message-received', compact('listMessage', 'company'));
    }

    public function findAllMessage($from, $to)
    {
        $listMessage = Chat::where([
            ['from_user_id', $from],
            ['to_user_id', $to],
        ])->orderBy('id', 'asc')->get();
        return view('frontend.pages.message.two-way-message', compact('listMessage'));
    }
}

