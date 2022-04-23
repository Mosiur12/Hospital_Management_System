<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        $image = $request->file('image');
        $imagename = time().'_category.'.$image->getClientOriginalExtension();
        $path = 'assets/images/category/';
        $image->move($path, $imagename);

        $data = new Category();
        $data->name = $request->name;
        $data->icon = $request->icon;
        $data->image = $path.$imagename;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;

        $data->save();

        Toastr::success('Category successfully create', 'Success');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'image' => 'mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'_category.'.$image->getClientOriginalExtension();
            $path = 'assets/images/category/';

            if (file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $category->image;
        }

        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->image = $img;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->update();

        Toastr::success('Category successfully Updated', 'Success');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if (file_exists(public_path($category->image)))
        {
            unlink(public_path($category->image));
        }

        Toastr::success('Category successfully Deleted', 'Success');

        return redirect()->route('admin.categories.index');
    }
}
