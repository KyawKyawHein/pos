<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class CategoryController extends Controller
{
    //category list

    public function list(){
        $category = Category::when(request("key"),function($query){
            $query->where("name","like","%".request("key")."%");
        })
        ->orderBy("id","desc")
        ->paginate(4);
        $category->appends(request()->all());
         return view("admin.category.categorylist",compact("category"));
    }

    //category create page

    public function categoryCreatePage(){
       return view("admin.category.create");
    }

    //category create

    public function categoryCreate( Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->getUserData($request);
        Category::create($data);
        return redirect()->route("category#list");
    }

    //category edit

    public function categoryEditPage($id){

        $categoryName = Category::where("id",$id)->first();
        return view("admin.category.edit",compact("categoryName"));
    }

    //category update


    public function categoryUpdate(Request $request){
       $this->categoryValidationCheck($request);
       $data = $this->getUserData($request);
        Category::where("id",$request->categoryId)->update($data);
        return redirect()->route("category#list");
    }

    //category delete
    public function delete($id){
       Category::where("id",$id)->delete();
       return redirect()->route("category#list");
    }

    //validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            "categoryName" => "min:2 | required |unique:categories,name,".$request->categoryId
        ])->validate();
    }



    //get data
    private function getUserData($request){
        return [
            "name" => $request->categoryName
        ];
    }


}
