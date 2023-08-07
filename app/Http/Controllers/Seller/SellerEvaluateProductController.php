<?php

namespace App\Http\Controllers\Seller;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Controller;
use App\Models\EvaluateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerEvaluateProductController extends Controller
{
    public function index()
    {
        // Join 2 table: evaluate_products and products to export data necessary from before condition
        try {
            $eva = DB::table('evaluate_products')
                ->join('products', 'products.id', '=', 'evaluate_products.product_id')
                ->where([['products.user_id', '=', Auth::user()->id], ['status', '!=', EvaluateProductStatus::DELETED]])
                ->select('evaluate_products.*')
//            ->orderByDesc('evaluate_products.id')
                ->get();

        } catch (\Exception $exception) {
            $eva[] = null;
        }

        return view('backend/evaluate/list')->with('evaluates', $eva);
    }

    public function detail($id)
    {
        $evaluate = EvaluateProduct::find($id);
        if ($evaluate != null || $evaluate->status != EvaluateProductStatus::DELETED) {
            return view('backend/evaluate/detail')->with('evaluate', $evaluate);
        }
        return redirect(route('seller.evaluates.index'));
    }

    public function update($id, Request $request)
    {
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

    public function delete($id)
    {
        $evaluate = EvaluateProduct::find($id);
        if ($evaluate != null || $evaluate->status != EvaluateProductStatus::DELETED) {
            $evaluate->status = EvaluateProductStatus::DELETED;
            $evaluate->save();
        }
        return redirect(route('seller.evaluates.index'));
    }
}
