<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\WishListOLD;
use App\Models\Product;


class WishListController extends Controller
{

    public function wishListIndex()
    {

        $wishListItems = DB::table('wish_lists')->where('user_id', '=', Auth::user()->id)->get();
        $productIds = [];
        foreach ($wishListItems as $productId) {
            array_push($productIds, $productId->product_id);
        }
        $productLists = Product::where('id', $productIds)->get();
        return view('frontend/pages/profile/wish-lists', compact('productLists','wishListItems'));
//        $userId = Auth::id();
//        $wishListItems = WishList::where('user_id', $userId)->get();
//        return view('frontend.pages.profile.wish-lists', compact('wishListItems'));
    }


    public function create()
    {
        //
    }


    public function wishListStore(Request $request)
    {
        if (Auth::check()) {
            $productId = $request->input('idProduct');
            $userId = Auth::user()->id;

            $existingWishList = WishList::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingWishList) {
                return response()->json(['message' => 'Sản phẩm này đã có trong danh sách yêu thích của bạn'], 200);
            }

            WishList::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            return response()->json(['message' => 'Sản phẩm được thêm vào danh sách yêu thích thành công.'], 200);
        } else {
            return response()->json(['message' => 'Bạn cần đăng nhập để sử dụng tính năng này.'], 401);
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

    public function wishListSoftDelete(Request $request, $id)
    {
        $wishList = WishListOLD::findOrFail($id);

        $wishList->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa'], 200);
    }

}
