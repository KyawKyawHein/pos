<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //admin order page

    public function adminOrderPage(){
        $order = Order::select("orders.*","users.name as user_name","users.email as user_email")
            ->when(request("key"),function($query){
            $query->orWhere("users.name","like","%".request("key")."%")
                  ->orWhere("users.email","like","%".request("key")."%");
        })
        ->orderBy("created_at","asc")
        ->leftJoin("users","orders.user_id","users.id")
        ->paginate(8);
        $pOrder = Order::where("status","0")->get();
        $sOrder = Order::where("status","1")->get();
        $dOrder = Order::where("status","2")->get();
        $rOrder = Order::where("status","3")->get();
        return view("admin.order.orderlist",compact("order","pOrder","sOrder","dOrder","rOrder"));
    }

    //admin order status

    public function orderStatus(Request $request){

        $order = Order::select("orders.*","users.name as user_name","users.email as user_email")
                        ->orderBy("created_at","asc")
                        ->leftJoin("users","orders.user_id","users.id");

            if($request->orderStatus == null){
                $order = $order->get();
            }else{
                $order = $order->where("status",$request->orderStatus)->get();
            }
         $pOrder = Order::where("status","0")->get();
        $sOrder = Order::where("status","1")->get();
        $dOrder = Order::where("status","2")->get();
        $rOrder = Order::where("status","3")->get();
    return view("admin.order.orderlist",compact("order","pOrder","sOrder","dOrder","rOrder"));
    }

    //admin order status change

    public function changeOrderStatus(Request $request){
       $data= $this->getOrderData($request);
        Order::where("id",$request->id)->update($data);

        return response()->json(["message"=>"success"],200);
    }

    //admin order detail page

    public function adminOrderDetailPage($id){
        $detail = Order::select("orders.*","users.name as user_name","users.email as user_email",
                    "users.phone as user_phone","users.address as user_address","users.image as user_image","order_lists.product_id as product_id",
                    "order_lists.quantity as quantity","products.name as product_name","products.image as product_image",
                    "products.price as product_price")
                    ->where("orders.id",$id)
                    ->leftJoin("users","orders.user_id","users.id")
                    ->leftJoin("order_lists","orders.order_code","order_lists.order_code")
                    ->leftJoin("products","order_lists.product_id","products.id")
                    ->get();

        return view("admin.order.orderDetail",compact("detail"));
    }












    //user order page

    public function userOrderPage(){

        $order = Order::select("orders.*","users.name as user_name")
                       ->leftJoin("users","orders.user_id","users.id")
                       ->where("orders.user_id",Auth::user()->id)
                       ->get();

        return view("user.order.orderPage",compact("order"));
    }

    //order detail page

    public function userOrderDetailPage($code){


       $detail = OrderList::select("order_lists.*","products.name as product_name","products.price as product_price","products.image as product_image")
                            ->where("order_code",$code)
                            ->leftJoin("products","order_lists.product_id","products.id")
                            ->get();

      $futureDate = $detail[0]->created_at->addDays(5);

      $order = Order::where("order_code",$code)->first();



       return view("user.order.detail",compact("detail","futureDate","order"));
    }
    //get order data

    private function getOrderData($request){
        return [
            "status" => $request->status,
        ];
    }
}
