<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function info() {
        return view('frontend/pages/profile/info');
    }
    public function my_notification() {
        return view('frontend/pages/profile/my-notification');
    }
    public function order_management() {
        return view('frontend/pages/profile/order-management');
    }
    public function return_management() {
        return view('frontend/pages/profile/return-management');
    }
    public function address_book() {
        return view('frontend/pages/profile/address-book');
    }
    public function payment_information() {
        return view('frontend/pages/profile/payment-information');
    }
    public function product_evaluation() {
        return view('frontend/pages/profile/product-evaluation');
    }
    public function favorite_product() {
        return view('frontend/pages/profile/favorite-product');
    }
    public function product_viewed() {
        return view('frontend/pages/profile/product-viewed');
    }
    public function my_review() {
        return view('frontend/pages/profile/my-review');
    }
}
