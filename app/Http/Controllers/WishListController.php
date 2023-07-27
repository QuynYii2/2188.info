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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishListIndex()
    {
        $listWishlists = DB::table('Wish_Lists')->where('user_id', '=', Auth::user()->id)->get();
        $productIds = [];

        foreach ($listWishlists as $productId) {
            array_push($productIds, $productId->product_id);
        }

        $productLists = Product::where('id', $productIds)->get();

        return view('frontend/pages/profile/wish-lists', compact('productLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wishListStore(Request $request)
    {

        $productId = $request->input('idProduct');
        $userId = Auth::user()->id;
        $existingWishList = DB::table('Wish_Lists')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if ($existingWishList) {
            return response()->json(['message' => 'Sản phẩm này đã có trong danh sách yêu thích của bạn'], 200);
        }
        $newWishList = new WishLists();
        $newWishList->user_id = $userId;
        $newWishList->product_id = $productId;
        $newWishList->save();
        return response()->json(['message' => 'Sản phẩm được thêm vào danh sách yêu thích thành công.'], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        $wishlist = DB::table('wishlists')->where('user_id', $userId)
            ->where('id', $id)
            ->first();

        if (!$wishlist) {
            return redirect()->route('wishlist.index')->with('error', 'Wishlist không tồn tại.');
        }

        DB::table('wishlists')->where('id', $id)->delete();

        return redirect()->route('wishlist.index')->with('success', 'Wishlist đã được xóa thành công.');
    }
}
