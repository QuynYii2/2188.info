<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StorageProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        return view('backend.storage-manage.index', compact('storages'));
    }

    public function allStorage()
    {
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

    public function searchStorage(Request $request)
    {
        $query = [];
        $name = $request->input('name-search');
        $price = $request->input('price-search');
        $origin = $request->input('origin-search');
        $importer = $request->input('importer-search');

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
        if ($importer) {
            $idUser = User::where([['name', 'like', '%' . $importer . '%']])->get('id');
            foreach ($idUser as $id) {
                $str = ['create_by', '=', $id->id];
                array_push($query, $str);
            }
        }
        if (!$checkRole) {
            $str = ['create_by', '=', Auth::user()->id];
            array_push($query, $str);
        }
        $storages = StorageProduct::where($query)->get();
        return view('backend.storage-manage.index', compact('storages'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.storage-manage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
        }

        $storage = new StorageProduct();

        $userLogin = $request->session()->get('login');
        $userInfo = User::where('email', $userLogin)->first();

        $storage->name = $request->input('name');
        $storage->price = $request->input('price');
        $storage->quantity = $request->input('quantity');
        $storage->origin = $request->input('origin');
        $galleryString = implode(',', $galleryPaths);
        $storage->gallery = $galleryString;
        $storage->create_By = Auth::user()->id;
        $storage->updated_By = "";
        $createProduct = $storage->save();

        return $this->allStorage();
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
        $storage = StorageProduct::findOrFail($id);
        return view('backend.storage-manage.edit', compact('storage'));
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

        return $this->allStorage();
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
