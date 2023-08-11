<?php

namespace App\Http\Controllers;

use App\Models\WishLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
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

        $productId = $request->input('idProduct');
        $userId = Auth::user()->id;
        $existingWishList = DB::table('wish_lists')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if ($existingWishList) {
            return response()->json(['message' => 'Sản phẩm này đã có trong danh sách yêu thích của bạn'], 200);
        }
        $newWishList = new WishList();
        $newWishList->user_id = $userId;
        $newWishList->product_id = $productId;
        $newWishList->save();
        return response()->json(['message' => 'Sản phẩm được thêm vào danh sách yêu thích thành công.'], 200);
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

    public function wishListSotfDelete(Request $id)
    {
        $wishList = Wishlist::find($_POST['id']);
        if ($wishList) {
            $wishList->delete();
            return response()->json(['message' => 'sản pẩm đã được xóa'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
    }
}
