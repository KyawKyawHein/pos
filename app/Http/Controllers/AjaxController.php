<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //product sorting

    public function productList(Request $request){
        if($request->status == "asc"){
            $product = Product::select("products.*","categories.name as category_name","categories.id as category_id")->orderBy("products.created_at","asc")->leftJoin("categories","products.category_id","categories.id")->get();
        }
        elseif($request->status == "desc"){
            $product = Product::select("products.*","categories.name as category_name","categories.id as category_id")->orderBy("products.created_at","desc")->leftJoin("categories","products.category_id","categories.id")->get();
        }
        return response()->json($product,200);

    }
    //add to cart

    public function addToCart(Request $request){

        $data = $this->getProductData($request);
        Cart::create($data);
        return response()->json(["Message" => "Cart is created successfully"],200);

    }

    //remove individual product btn

    public function removeBtn(Request $request){
        $response = Cart::where("id",$request->orderId)->where("product_id",$request->productId)->delete();
        return response()->json($response,200);
    }
    //remove entire cart btn

    public function clearCartBtn(Request $request){
         Cart::where("user_id",Auth::user()->id)->delete();
        return response()->json(["message" => "success"],200);
    }
    //checkout the cart for order

    public function checkoutBtn(Request $request){


        //create a variable for total price to add in order db
        $total = 0;

        //create orderlist for all the item in cart in for each loop


        foreach($request->all() as $orderItem){
            $data = OrderList::create([
                "user_id" => $orderItem["user_id"],
                 "order_code" => $orderItem["order_code"],
                 "product_id" => $orderItem["product_id"],
                 "quantity" => $orderItem["quantity"],
                 "total" => $orderItem["total"],
            ]);
        // add the total from 
        $total = $data->total;

        }

        Cart::where("user_id",Auth::user()->id)->delete();

        Order::create([
            "user_id" => Auth::user()->id,
            "order_code" => $data->order_code,
            "total_price" => $total,
        ]);

        return response()->json(["status" => "success"],200);
    }
    //get product data

    private function getProductData(Request $request){
        return [
            "user_id" => $request->user_id,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "updated_at" => Carbon::now(),
        ];
    }
}
