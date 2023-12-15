<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\StorageProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        return view('backend.storage-manage.index', compact('storages'));
    }

    public function searchStorage(Request $request)
    {
        (new HomeController())->getLocale($request);
        $query = [];
        $name = $request->input('name-search');
        $price = $request->input('price-search');
        $origin = $request->input('origin-search');
        $from_date = $request->input('from-date');
        $to_date = $request->input('to-date');

        $checkRole = false;
        $id = Auth::user()->id;
        $roles = DB::table('role_user')->where('user_id', $id)->get('role_id');
        foreach ($roles as $role) {
            if ($role->role_id == 1) {
                $checkRole = true;
                break;
            }
        }
        if ($name) {
            $str = ['name', 'like', '%' . $name . '%'];
            array_push($query, $str);
        }
        if ($price) {
            $str = ['price', 'like', '%' . $price . '%'];
            array_push($query, $str);
        }
        if ($origin) {
            $str = ['origin', 'like', '%' . $origin . '%'];
            array_push($query, $str);
        }
        if (!$checkRole) {
            $str = ['create_by', '=', Auth::user()->id];
            array_push($query, $str);
        }
        if ($from_date) {
            $str = ['created_at', '>=', $from_date . ' 00:00:00'];
            array_push($query, $str);
        }
        if ($to_date) {
            $str = ['created_at', '<=', $to_date . ' 23:59:59'];
            array_push($query, $str);
        }

        $storages = StorageProduct::where($query)->get();
        return view('backend.storage-manage.index', compact('storages'));

    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('backend.storage-manage.create');
    }

    public function edit(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $storage = StorageProduct::findOrFail($id);
        return view('backend.storage-manage.edit', compact('storage'));
    }

    public function update(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $storage = StorageProduct::findOrFail($id);

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
            $galleryString = implode(',', $galleryPaths);
            $storage->gallery = $galleryString;
        }

        $storage->name = $request->input('name');
        $storage->price = $request->input('price');
        $storage->quantity = $request->input('quantity');
        $storage->origin = $request->input('origin');
        $storage->updated_By = Auth::user()->id;
        $storage->save();

        return $this->allStorage($request);
    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
        }

        $storage = new StorageProduct();


        $storage->name = $request->input('name');
        $storage->price = $request->input('price');
        $storage->quantity = $request->input('quantity');
        $storage->origin = $request->input('origin');
        $galleryString = implode(',', $galleryPaths);
        $storage->gallery = $galleryString;
        $storage->create_By = Auth::user()->id;
        $storage->updated_By = "";

        $isCheck = $this->isStorageExist($storage);

        if (!$isCheck) {
            alert()->error('Error', 'Đã tồn tại');
            return back();
        }
        $storage->save();
        alert()->success('Success', 'Thêm mới thành công');

        return $this->allStorage($request);
    }

    public function isStorageExist($storageCheck)
    {
        $name = $storageCheck->name;
        $price = $storageCheck->price;
        $quantity = $storageCheck->quantity;
        $origin = $storageCheck->origin;

        $storages = StorageProduct::where([
            ['name', '=', $name],
            ['origin', '=', $origin]
        ])->get();

        if (count($storages) != 0) {
            foreach ($storages as $storage) {
                if ($storage->price == $price) {
                    return false;
                }
            }
        }

        return true;
    }

    public function allStorage(Request $request)
    {
        (new HomeController())->getLocale($request);
        $id = Auth::user()->id;
        $roles = DB::table('role_user')->where('user_id', $id)->orderBy('role_id')->get('role_id');
        foreach ($roles as $role) {
            if ($role->role_id == 1) {
                $storages = StorageProduct::all();
                return view('backend.storage-manage.index', compact('storages'));
            }
        }
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        return view('backend.storage-manage.index', compact('storages'));
    }
}
