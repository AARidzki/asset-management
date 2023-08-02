<?php

namespace App\Http\Controllers\API;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\LocationResource;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get locations
        $locations = Location::latest()->paginate(5);

        //return collection of locations as a resource
        return new LocationResource(true, 'List Data Location', $locations);
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
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $location = Location::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name
        ]);

        //return response
        return new LocationResource(true, 'Data Location Berhasil Ditambahkan!', $location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
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
            $location->update([
                'name'     => $request->name,
            ]);


        //return response
        return new LocationResource(true, 'Data Location Berhasil Diubah!', $location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //delete post
        $location->delete();

        //return response
        return new LocationResource(true, 'Data Location Berhasil Dihapus!', null);
    }

    public function searchLocation(Request $request)
    {
        // menangkap data pencarian
		$search = $request->search;
 
        // mengambil data dari table pegawai sesuai pencarian data
        $locations = DB::table('locations')
        ->where('name','like',"%".$search."%")
        ->paginate(5);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Location Berhasil dicari',
            'data' => $locations
        ], 200);
    }
}
