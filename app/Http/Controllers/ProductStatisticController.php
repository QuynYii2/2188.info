<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatistic;
use Illuminate\Http\Request;

class ProductStatisticController extends Controller
{
    public function updateViewCount(Request $request, Product $product)
    {
        $countryCode = $request->input('country_code');

        $productStatistic = ProductStatistic::where('product_id', $product->id)
            ->where('country_code', $countryCode)
            ->first();

        if (!$productStatistic) {
            $productStatistic = new ProductStatistic([
                'product_id' => $product->id,
                'country_code' => $countryCode,
            ]);
        }

        $productStatistic->view_count++;
        $productStatistic->save();

        return response()->json([
            'message' => 'View count updated successfully.',
        ]);
    }

    public function updateSaleCount(Request $request, Product $product)
    {
        $countryCode = $request->input('country_code');

        $productStatistic = ProductStatistic::where('product_id', $product->id)
            ->where('country_code', $countryCode)
            ->first();

        if (!$productStatistic) {
            $productStatistic = new ProductStatistic([
                'product_id' => $product->id,
                'country_code' => $countryCode,
            ]);
        }

        $productStatistic->sale_count++;
        $productStatistic->save();

        return response()->json([
            'message' => 'Sale count updated successfully.',
        ]);
    }

    public function getTopViewedProducts($countryCode)
    {
        $topViewedProducts = ProductStatistic::where('country_code', $countryCode)
            ->orderBy('view_count', 'desc')
            ->take(10)
            ->with('product')
            ->get();

        return response()->json($topViewedProducts);
    }

    public function getTopSoldProducts($countryCode)
    {
        $topSoldProducts = ProductStatistic::where('country_code', $countryCode)
            ->orderBy('sale_count', 'desc')
            ->take(10)
            ->with('product')
            ->get();

        return response()->json($topSoldProducts);
    }
}
