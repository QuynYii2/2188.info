<?php

namespace App\Http\Controllers\Seller;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerEvaluateProductController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        // Join 2 table: evaluate_products and products to export data necessary from before condition
        try {
            $userId = Auth::id(); // Use Auth::id() for better readability
            $eva = DB::table('evaluate_products')
                ->join('products', 'products.id', '=', 'evaluate_products.product_id')
                ->where('products.user_id', $userId)
                ->where('evaluate_products.status', '!=', EvaluateProductStatus::DELETED)
                ->select('evaluate_products.*')
                ->get();

        } catch (\Exception $exception) {
            $eva = null;
        }

        return view('backend/evaluate/list')->with('evaluates', $eva);
    }

    public function detail(Request$request,$id)
    {
        (new HomeController())->getLocale($request);
        $evaluate = EvaluateProduct::find($id);
        if ($evaluate != null || $evaluate->status != EvaluateProductStatus::DELETED) {
            return view('backend/evaluate/detail')->with('evaluate', $evaluate);
        }
        return redirect(route('seller.evaluates.index'));
    }

    public function update($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $evaluate = EvaluateProduct::find($id);
        $status = $request->input('status');
        if ($evaluate != null || $evaluate->status != EvaluateProductStatus::DELETED) {
            if ($status != EvaluateProductStatus::DELETED) {
                $evaluate->status = $status;
                $evaluate->save();
            }
        }
        return redirect(route('seller.evaluates.index'));
    }

    public function delete(Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        $evaluate = EvaluateProduct::find($id);
        if ($evaluate != null || $evaluate->status != EvaluateProductStatus::DELETED) {
            $evaluate->status = EvaluateProductStatus::DELETED;
            $evaluate->save();
        }
        return redirect(route('seller.evaluates.index'));
    }
}
