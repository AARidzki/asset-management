<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get categories
        $categories = Category::latest()->paginate(5);

        //return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
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
        $category = Category::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name
        ]);

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Ditambahkan!', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
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
            $category->update([
                'name'     => $request->name,
            ]);


        //return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete image
        // Storage::delete('public/posts/'.$post->image);

        //delete post
        $category->delete();

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }

    public function searchCategory(Request $request)
    {
        // menangkap data pencarian
		$search = $request->search;
 
        // mengambil data dari table pegawai sesuai pencarian data
        $categories = DB::table('categories')
        ->where('name','like',"%".$search."%")
        ->paginate(5);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Category Berhasil dicari',
            'data' => $categories
        ], 200);
    }
}
