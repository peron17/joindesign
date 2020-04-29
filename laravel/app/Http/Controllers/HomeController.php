<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $model = Product::paginate(12);

        return view('welcome', ['model' => $model]);
    }
}
