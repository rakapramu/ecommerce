<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // agar tidak bisa diakses sebelum login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // mendapatkan carts yang sedang login saja
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        // mengantisipasi jika user memilih barang yang sama lebih dari sekali
        $duplicate = Cart::where('product_id', $request->product_id)->first();
        if ($duplicate) {
            return redirect('/cart')->with('error', 'Barang telah ada di cart');
        }


        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => 1
        ]);
        return redirect('/cart')->with('succes', 'Berhasil menabahkan barang di cart');
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->update([
            'qty' => $request->quantity
        ]);
        return response()->json([
            'succes' => true
        ]);
    }

    public function delete($id)
    {
        Cart::destroy($id);
        return back();
    }
}
