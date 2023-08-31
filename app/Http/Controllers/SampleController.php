<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    protected $locale;

    public function __construct(Request $request)
    {
        parent::__construct();

        $homeController = new HomeController();
        $this->locale = $homeController->getLocale($request);
    }

    public function chat(Request $request)
    {
        return view('frontend.pages.message.chat');
    }

    public function getListMessageSent()
    {
        $listMessage = Chat::where('from_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);
        return view('frontend.pages.message.message-sent', compact('listMessage'));
    }

    public function getListMessageReceived()
    {
        $listMessage = Chat::where('to_user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);
        return view('frontend.pages.message.message-received', compact('listMessage'));
    }
}

