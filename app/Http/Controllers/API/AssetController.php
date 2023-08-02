<?php

namespace App\Http\Controllers\API;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssetResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get Assets
        $assets = Asset::latest()->paginate(5);

        //return collection of assets$assets as a resource
        return new AssetResource(true, 'List Data Assets', $assets);
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
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_aset'     => 'required',
            'category_id'     => 'required',
            'location_id'     => 'required',
            'jumlah'     => 'required',
            'nilai'     => 'required',
            'umur'     => 'required',
            'total'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $asset = Asset::create([
            // 'image'     => $image->hashName(),
            'nama_aset'     => $request->nama_aset,
            'category_id'     => $request->category_id,
            'location_id'     => $request->location_id,
            'jumlah'     => $request->jumlah,
            'nilai'     => $request->nilai,
            'umur'     => $request->umur,
            'total'     => $request->total,
        ]);

        //return response
        return new AssetResource(true, 'Data Asset Berhasil Ditambahkan!', $asset);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_aset'     => 'required',
            'category_id'     => 'required',
            'location_id'     => 'required',
            'jumlah'     => 'required',
            'nilai'     => 'required',
            'umur'     => 'required',
            'total'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        // if ($request->hasFile('image')) {

        //     //upload image
        //     $image = $request->file('image');
        //     $image->storeAs('public/posts', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/posts/'.$post->image);

        //     //update post with new image
        //     $post->update([
        //         'image'     => $image->hashName(),
        //         'name'     => $request->name,
        //         'content'   => $request->content,
        //     ]);

        // } else {

            //update post without image
            $asset->update([
                'nama_aset'     => $request->nama_aset,
                'category_id'     => $request->category_id,
                'location_id'     => $request->location_id,
                'jumlah'     => $request->jumlah,
                'nilai'     => $request->nilai,
                'umur'     => $request->umur,
                'total'     => $request->total,
            ]);


        //return response
        return new AssetResource(true, 'Data Asset Berhasil Diubah!', $asset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //delete post
        $asset->delete();

        //return response
        return new AssetResource(true, 'Data Asset Berhasil Dihapus!', null);
    }
}
