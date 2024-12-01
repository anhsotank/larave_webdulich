<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Str;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::orderBy('id', 'DESC')->get();

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'descripsion' => 'required',
            'price' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);
        $category = new Category();
        $category->title = $data['title'];
        $category->price = $data['price'];
        $category->status = $data['status'];
        $category->descripsion = $data['descripsion'];
        $category->slug = Str::slug($data['title']);
        //thêm hinhd ảnh vvao

        $get_image = $request->image;
        $spath = "uploads/categories";
        $getnameimage = $get_image->getClientOriginalname();
        $name_image = current(explode(".", $getnameimage));
        $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($spath, $new_image);
        $category->image = $new_image;
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'descripsion' => 'required',

            'status' => 'required',
        ]);
        $category = Category::find($id);
        $category->title = $data['title'];

        $category->status = $data['status'];
        $category->descripsion = $data['descripsion'];
        $category->slug = Str::slug($data['title']);
        //thêm hinhd ảnh vvao
        if ($request->image) {
            $get_image = $request->image;
            $spath = "uploads/categories";
            $getnameimage = $get_image->getClientOriginalname();
            $name_image = current(explode(".", $getnameimage));
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($spath, $new_image);
            $category->image = $new_image;

        }
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find(id: $id);
        $category->delete();
        return redirect()->route(route: 'categories.index');
    }
}
