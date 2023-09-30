<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    //cart home page

    public function cartPage()
    {
        $cart = Cart::select("carts.*","products.id as product_id","products.name as product_name","products.image as product_image","products.price as product_price")
        ->where("carts.user_id",Auth::user()->id)
        ->leftJoin("products","carts.product_id","products.id")
        ->get();
        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice += $c->product_price * $c->quantity;
        }
        return view("user.cart.main",compact("cart","totalPrice"));
    }
}
