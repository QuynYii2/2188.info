<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ShopInformationController;
use App\Models\PaymentMethod;
use App\Models\ShopInfo;
use App\Models\TransportMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class SettingShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::where('id', Auth::user()->id)->first(['payment_method', 'transport_method']);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        return view('backend/shop_setting/index', compact('listPayment', 'listTransport', 'list'));
    }

    public function profileShop()
    {
        $user = Auth::user();
        $shop_infos = ShopInfo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        // nếu $shop_infos tồn tại thì gọi update còn neeus ko có thì gọi view create
        if ($shop_infos) {
            return view('backend/shop_profile/update', compact('user', 'shop_infos'));
        } else {
            return view('backend/shop_profile/index', compact('user', 'shop_infos'));
        }

    }

    public function updateProfileShop(Request $request)
    {
        try {
            $user = Auth::user();
            $shopinformation = ShopInfo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            $shopinformation->user_id = Auth::user()->id;
            $shopinformation->name = $request->input('name');
            $shopinformation->country = $request->input('region');
            $shopinformation->masothue = $request->input('rental_code');
            $shopinformation->product_name = $request->input('product_name');
            $shopinformation->product_code = $request->input('product_code');
            $shopinformation->product_key = $request->input('product_key');
            $shopinformation->information = $request->input('information');
            $shopinformation->business_license = $request->input('business_license');
            $shopinformation->acreage = $request->input('acreage');
            $shopinformation->industry_year = $request->input('industry_year');
            $shopinformation->machine_number = $request->input('machine_number');
            $shopinformation->marketing = $request->input('marketing');
            $shopinformation->customers = $request->input('customers');
            $shopinformation->inspection_staff = $request->input('inspection_staff');
            $shopinformation->test_method = $request->input('test_method');
            $shopinformation->annual_output = $request->input('annual_output');
            $shopinformation->partner = $request->input('partner');

            if ($request->hasFile('image')) {
                $thumbnail = $request->file('image');
                $thumbnailPath = $thumbnail->store('images', 'public');
                $user->image = $thumbnailPath;
                $user->save();
            }

            $success = $shopinformation->save();
            if ($success) {
                alert()->success('Success', 'Success, Save success');
                return redirect(route('profile.shop.index'));
            }
            alert()->error('Error', 'Error, save error');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again');
            return back();
        }

    }

    public function saveProfileShop(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->region = $request->input('region');
        $user->rental_code = $request->input('rental_code');
        $user->product_name = $request->input('product_name');
        $user->product_code = $request->input('product_code');

        $user->industry = $request->input('industry');
        if ($request->hasFile('image')) {
            $gallery = $request->file('image');
            $galleryPath = $gallery->store('images', 'public');
            $user->image = $galleryPath;
        }
        $user->save();

        $infoShop = (new ShopInformationController())->store($request);
        return redirect()->route('profile.shop.index')->with('success', 'Thông tin cửa hàng đã được cập nhật.');
    }


    public function savePaymentMethod(Request $request)
    {
        $user = Auth::user();
        $user->payment_method = implode(',', $request->input('payment_method'));
        $user->save();
        return $this->index();
    }

    public function saveTransportMethod(Request $request)
    {
        $user = Auth::user();
        $user->transport_method = implode(',', $request->input('transport_method'));
        $user->save();
        return $this->index();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
