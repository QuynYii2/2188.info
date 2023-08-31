<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    public function chat(Request $request){
        (new HomeController())->getLocale($request);
        return view('frontend.pages.message.chat');
    }

    public function getListMessageSent(Request $request){
        (new HomeController())->getLocale($request);
        $listMessage = Chat::where('from_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);
        return view('frontend.pages.message.message-sent', compact('listMessage'));
    }

    public function getListMessageReceived(Request $request){
        (new HomeController())->getLocale($request);
        $listMessage = Chat::where('to_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);
        return view('frontend.pages.message.message-received', compact('listMessage'));
    }
}
