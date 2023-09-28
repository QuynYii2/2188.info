<?php

namespace App\Http\Controllers;

use App\Enums\AttributeStatus;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function testAttribute()
    {
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        return view('backend.products.demo', compact('attributes'));
    }
}
