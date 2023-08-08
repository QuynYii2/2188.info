<?php

namespace App\Http\Controllers;

use App\Models\ImageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function saveImgByUser(Request $request)
    {
        $obj = new ImageUser();

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
            $galleryString = implode(',', $galleryPaths);
            $obj->url_image = $galleryString;
            $obj->user_id = Auth::user()->id;
            $obj->save();
            return response()->json($galleryString);

        }
        return response()->json("Error");


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

    public function getListImgByUser()
    {
        $listImg = ImageUser::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get('url_image');
        $arrImg = [];

        foreach ($listImg as $item) {
            $arr = explode(',', $item->url_image);
            foreach ($arr as $item) {
                array_push($arrImg, $item);
            }
        }
        return response()->json($arrImg);
    }
}
