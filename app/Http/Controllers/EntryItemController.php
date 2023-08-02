<?php

namespace App\Http\Controllers;

use App\Models\Entry_Item;
use App\Http\Requests\StoreEntry_ItemRequest;
use App\Http\Requests\UpdateEntry_ItemRequest;

class EntryItemController extends Controller
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
     * @param  \App\Http\Requests\StoreEntry_ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntry_ItemRequest $request)
    {
        //
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
     * @param  \App\Http\Requests\UpdateEntry_ItemRequest  $request
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntry_ItemRequest $request, Entry_Item $entry_Item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry_Item  $entry_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry_Item $entry_Item)
    {
        //
    }
}
