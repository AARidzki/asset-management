<?php

namespace App\Http\Controllers\API;

use App\Models\Monitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MonitorResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get monitors
        $monitors = Monitor::latest()->paginate(5);

        //return collection of monitors as a resource
        return new MonitorResource(true, 'List Data Monitors', $monitors);
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
            'jumlah'     => 'required',
            'kondisi'     => 'required',
            'keterangan'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'tindakan'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('gambar');
        $image->storeAs('public/monitors', $image->hashName());

        //create post
        $monitor = Monitor::create([
            // 'image'     => $image->hashName(),
            'asset_id'     => $request->asset_id,
            'jumlah'     => $request->jumlah,
            'kondisi'     => $request->kondisi,
            'keterangan'     => $request->keterangan,
            'gambar'     => $image->hasName(),
            'tindakan'     => $request->tindakan,
        ]);

        //return response
        return new MonitorResource(true, 'Data Monitor Berhasil Ditambahkan!', $monitor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'asset_id'     => 'required',
            'jumlah'     => 'required',
            'kondisi'     => 'required',
            'keterangan'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'tindakan'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('gambar')) {

            //upload image
            $image = $request->file('gambar');
            $image->storeAs('public/monitors', $image->hashName());

            //delete old image
            Storage::delete('public/monitors/'.$monitor->image);

            //update monitor with new image
            $monitor->update([
                'asset_id'     => $request->asset_id,
                'jumlah'     => $request->jumlah,
                'kondisi'     => $request->kondisi,
                'keterangan'     => $request->keterangan,
                'gambar'     => $image->hasName(),
                'tindakan'     => $request->tindakan,
            ]);

        } else {

            //update post without image
            $monitor->update([
                'asset_id'     => $request->asset_id,
                'jumlah'     => $request->jumlah,
                'kondisi'     => $request->kondisi,
                'keterangan'     => $request->keterangan,
                // 'gambar'     => $image->hasName(),
                'tindakan'     => $request->tindakan,
            ]);
        }

        //return response
        return new MonitorResource(true, 'Data Monitor Berhasil Diubah!', $monitor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitor $monitor)
    {
        //delete image
        Storage::delete('public/monitors/'.$monitor->image);

        //delete monitor
        $monitor->delete();

        //return response
        return new MonitorResource(true, 'Data Monitor Berhasil Dihapus!', null);
    }
}
