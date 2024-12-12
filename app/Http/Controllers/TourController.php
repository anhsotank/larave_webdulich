<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TourController extends Controller
{
    public function index()
    {

    }


    // Hiển thị chi tiết danh mục theo ID
    public function show(string $id)
    {
        $category = Category::find($id);
        return view("pages.tour", compact("category"));
    }


}
