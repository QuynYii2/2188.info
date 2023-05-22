<?php

namespace App\Http\Controllers;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Requests\EvaluateProductRequest;
use App\Models\EvaluateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluateProductController extends Controller
{
    public function index(Request $request)
    {
        //

    }

//    public function getListByProductId(Request $request)
//    {
//        (new HomeController())->getLocale($request);
//        $result = EvaluateProduct::all()->where('product_id','=',$request->product_id);
//        return view('frontend/pages/detail-product')->with('result', $result);
//    }
//
//    public function create(Request $request)
//    {
//        (new HomeController())->getLocale($request);
//        return view('frontend/pages/detail-product');
//    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $evaluate = [
                'user_id' => Auth::user()->id,
                'username' => $request->input('username'),
                'product_id' => $request->input('product_id'),
                'star_number' => $request->input('star_number'),
                'content' => $request->input('content'),
                'status' => EvaluateProductStatus::PENDING
            ];
            EvaluateProduct::create($evaluate);
            return redirect(route('detail_product.show', ["id" => $request->input('product_id')]));
        } else {
            (new HomeController())->getLocale($request);
            return view('frontend/pages/login');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
