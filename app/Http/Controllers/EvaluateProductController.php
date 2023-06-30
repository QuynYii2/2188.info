<?php

namespace App\Http\Controllers;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluateProductController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
//            if($request->input('star_number') == null){
//                alert()->error('Error', '');
//                return back();
//            }
            $evaluate = [
                'user_id' => Auth::user()->id,
                'username' => $request->input('username'),
                'product_id' => $request->input('product_id'),
                'star_number' => $request->input('star_number'),
                'content' => $request->input('content'),
                'status' => EvaluateProductStatus::PENDING
            ];
            $success = EvaluateProduct::create($evaluate);
            if ($success) {
                alert()->success('Success', 'Change Email Success!');
                return redirect(route('detail_product.show', ["id" => $request->input('product_id')]));
            } else {
                alert()->error('Error', 'Change Email error!');
                return back();
            }
        } else {
            (new HomeController())->getLocale($request);
            return view('frontend/pages/login');
        }
    }
}
