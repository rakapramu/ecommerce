<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        // untuk mengambil data di tabel produk sebanyak 3 data saja
        $products = Product::take(3)->get();
        return view('welcome', compact('products'));
    }
}
