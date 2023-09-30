<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    //product list data

    public function productList(){
        $products = Product::get();
        return response()->json($products,200);
    }
    //product Create


    public function productCreate(Request $request){
        $product = Category::create($request->all());
        return response()->json($product,200);
    }
    //edit category

    public function editCategory(Request $request,$id){
        $category = Category::where("id",$id)->update($request->all());
        $message = "Category with Id "     .     $id     .  "has been updated successfully";
        return response()->json($message,200);
    }
    //delete category

    public function delete(Request $request){
        $valid =category::where("id",$request->id)->first();
        if($valid == null){
            return response()->json(["message"=>"it is not found"]);
        }else{
            $category = Category::where("id",$request->id)->delete();
            $message = "Category with Id". $request->id . "has been deleted successfully";
            return response()->json($message);
        }

    }
}
