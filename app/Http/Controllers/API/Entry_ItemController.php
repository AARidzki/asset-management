<?php

namespace App\Http\Controllers\API;

use App\Models\Entry_Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Entry_ItemResource;

class Entry_ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get entry_items
        $entry_Items = Entry_Item::latest()->paginate(5);

        //return collection of entry_Items as a resource
        return new Entry_ItemResource(true, 'List Data Entry Items', $entry_Items);
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
            'demand_id'     => 'required',
            'tanggal'     => 'required|date',
            'jumlah'     => 'required',
            'nilai'     => 'required',
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
        $entry_Item = Entry_Item::create([
            // 'image'     => $image->hashName(),
            'demand_id'     => $request->demand_id,
            'tanggal'     => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'nilai'     => $request->nilai,
            'total'     => $request->total,
        ]);

        //return response
        return new Entry_ItemResource(true, 'Data Entry Item Berhasil Ditambahkan!', $entry_Item);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function show(Entry_Item $entry_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry_Item $entry_Item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry_Item $entry_Item)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'demand_id'     => 'required',
            'tanggal'     => 'required|date',
            'jumlah'     => 'required',
            'nilai'     => 'required',
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
            $entry_Item->update([
                'demand_id'     => $request->demand_id,
                'tanggal'     => $request->tanggal,
                'jumlah'     => $request->jumlah,
                'nilai'     => $request->nilai,
                'total'     => $request->total,
            ]);


        //return response
        return new Entry_ItemResource(true, 'Data Entry Item Berhasil Diubah!', $entry_Item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry_Item $entry_Item)
    {
         //delete post
         $entry_Item->delete();

         //return response
         return new Entry_ItemResource(true, 'Data Entry Item Berhasil Dihapus!', null);
    }
}
