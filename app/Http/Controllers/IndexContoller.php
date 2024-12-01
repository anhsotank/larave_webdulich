<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
class IndexContoller extends Controller
{
    public function index()
    {

        $categories = Category::orderBy('id', 'DESC')->get();


        return view("pages.home", compact("categories"));
    }
}
