<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with(['product'])
            ->where('user_id', Auth::user()->id)
            ->get();

        $user = User::findOrFail(Auth::user()->id);

        return view('pages.cart', [
            'cart' => $cart,
            'user' => $user
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'product_id' => $id,
            'user_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect('cart');
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
