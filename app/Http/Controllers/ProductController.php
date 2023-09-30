<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductController extends Controller
{
    //product list

    public function list()
    {
        $product = Product::select("products.*","categories.id as category_id","categories.name as category_name")
        ->when(request("key"),function($find){
            $find->orWhere("products.name","like","%".request("key")."%")
                 ->orWhere("categories.name","like","%".request("key")."%");
                })
        ->orderBy("products.updated_at","desc")
        ->leftJoin("categories","products.category_id","categories.id")
        ->paginate(4);
       $product->appends(request()->all());

        return view("admin.product.list",compact("product"));
    }

    //product create page

    public function createPage(){

        $category = Category::select("id","name")->get();


        return view("admin.product.create",compact("category"));
    }


    //product create

    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->getProductData($request);

        $productImageName = uniqid().$request->file("image")->getClientOriginalName();

        $request->file("image")->storeAs("public",$productImageName);

        $data["image"] = $productImageName;

        // dd($data);
        Product::create($data);
        return redirect()->route("product#list");
    }

    //product edit page

    public function editPage($id){
        $category = Category::get();
        $product =Product::where("id",$id)->first();

        return view("admin.product.editpage",compact("product","category"));
    }


    //product delete

    public function delete($id){
        $image = Product::where("id",$id)->first();
        $image = $image->image;
        Product::where("id",$id)->delete();

        if($image !=null){
            Storage::delete("public/".$image);
        }
        return redirect()->route("product#list");
    }
    //product update

    public function update(Request $request){


        $this->productValidationCheck($request,"update");
        $data = $this->getProductData($request);
        if($request->hasFile("image")){
            $dbImage = Product::where("id",$request->productId)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete("public/".$dbImage);
            }
            $fileName = uniqid().$request->file("image")->getClientOriginalName();
            $request->file("image")->storeAs("public",$fileName);
            $data["image"] = $fileName;
        }
        Product::where("id",$request->productId)->update($data);
        return redirect()->route("product#list");

    }


    //user's product detail


    //product detail

    public function detail($id,$categoryId){


        $product = Product::select("products.*","categories.id as category_id","categories.name as category_name")
        ->leftJoin("categories","products.category_id","categories.id")
        ->where("products.id",$id)->first();

        $categoryP = Product::select("products.*","categories.id as category_id", "categories.name as category_name")
        ->whereNot("products.id",$id)
        ->where("products.category_id",$categoryId)
        ->leftJoin("categories","products.category_id","categories.id")
        ->get();



        return view("user.product.detail",compact("product","categoryP"));


    }

     //product validation check
    private function productValidationCheck($request,$action){
        $validationRule =[
            "productName" => "required|min:2|unique:products,name,".$request->productId,
                "categoryName" => "required",
                "productDescription" => "required|min:5",
                "productPrice" => "required",
        ];
        $validationRule["image"] = $action == "create" ? "file|mimes : jpeg,jpg,png,webg,webp required" : "file|mimes : jpeg,jpg,png,webg";
        Validator::make($request->all(),$validationRule)->validate();
    }

    //product get data


    private function getProductData($request){
        return [
            "name" => $request->productName,
            "category_id" => $request->categoryName,
            "description" => $request->productDescription,
            "price" => $request->productPrice,
            "updated_at" => Carbon::now(),
        ];
    }
}
