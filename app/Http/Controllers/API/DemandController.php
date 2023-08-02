<?php

namespace App\Http\Controllers\API;

use App\Models\Demand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get demands
        $demands = Demand::latest()->paginate(5);

        //return collection of demands as a resource
        return new DemandResource(true, 'List Data Demands', $demands);
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
            'asset_id'     => 'required',
            'location_id'     => 'required',
            'jumlah'     => 'required',
            'tgl'     => 'required|date',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $demand = Demand::create([
            // 'image'     => $image->hashName(),
            'asset_id'     => $request->asset_id,
            'location_id'     => $request->location_id,
            'jumlah'     => $request->jumlah,
            'tgl'     => $request->tgl,
        ]);

        //return response
        return new DemandResource(true, 'Data Demand Berhasil Ditambahkan!', $demand);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'asset_id'     => 'required',
            'location_id'     => 'required',
            'jumlah'     => 'required',
            'tgl'     => 'required|date',
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
            $demand->update([
                'asset_id'     => $request->asset_id,
                'location_id'     => $request->location_id,
                'jumlah'     => $request->jumlah,
                'tgl'     => $request->tgl,
            ]);


        //return response
        return new DemandResource(true, 'Data Demand Berhasil Diubah!', $demand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        //delete post
        $demand->delete();

        //return response
        return new DemandResource(true, 'Data Demand Berhasil Dihapus!', null);
    }
}
