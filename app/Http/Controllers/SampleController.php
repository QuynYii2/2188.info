<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function chat(){
        return view('frontend.pages.message.chat');
    }
}
