<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index($id = null)
    {
        $categories = Category::all();
        // untuk membuat pagination gunakan function paginate (isi mau berapa)
        $products = Product::paginate(12);
        return view('shop.index', compact('products', 'categories', 'id'));
    }

    // pilih category
    public function category($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->paginate(6);
        return view('shop.index', compact('products', 'categories', 'id'));
    }

    // menampilkan data by id
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
}
