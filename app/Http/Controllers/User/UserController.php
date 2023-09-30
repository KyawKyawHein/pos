<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page

    public function list(){
        $category = Category::orderBy("created_at","desc")->get();

        $product = Product::select("products.*","categories.id as category_id","categories.name as category_name")
        ->when(request("key"),function($query){
            $query->orWhere("products.name","like","%".request("key")."%")
                  ->orWhere("categories.name","like","%".request("key")."%");
        })
        ->leftJoin("categories","products.category_id","categories.id")
        ->orderBy("created_at","desc")->paginate(6);
        $product->appends(request()->all());
        $cart = Cart::where("user_id",Auth::user()->id)->get();
        return view("user.home",compact("category","product","cart"));
    }


    //filter product by category

    public function filter($id){
       $category = Category::paginate();
       $product = Product::where("category_id",$id)->orderBy("created_at","desc")->paginate(6);
        $cart = Cart::where("user_id",Auth::user()->id)->get();
       return view("user.home",compact("category","product","cart"));

    }
    //user account detail page

    public function account(){
        return view("user.account.detail");
    }
    //user edit page

    public function editPage(){
        return view("user.account.editPage");
    }
    //account update
    public function accountUpdate($id,Request $request){
        $this->ValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile("userImage")){
            $dbImage = User::where("id",$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage !=null){
                Storage::delete("public/".$dbImage);
            }
            $fileName = uniqid().$request->file("userImage")->getClientOriginalName();
            $request->file("userImage")->storeAs("public",$fileName);
            $data["image"] = $fileName;
        }
        User::where("id",$id)->update($data);
        return redirect()->route("user#account");
    }
    //password change page

    public function changePasswordPage(){
        return view("user.account.chamgePassword");
    }


    // password updated
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $userId = Auth::user()->id;
        $dbPassword = User::select("password")->where("id",$userId)->first();
        $dbPassword = $dbPassword->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
           $updatePassword = [
            "password" => Hash::make($request->newPassword)
           ];
           User::where("id",$userId)->update($updatePassword);
           return redirect()->route("user#changePasswordPage")->with(["Match" => "Password Changed Successfully"]);


        }else{
            return back()->with(["notMatch" => "Fail to Change Password"]);
        }
    }

    //validate the request
    private function ValidationCheck($request){
        Validator::make($request->all(),[
            "userName" => "required|min:3|max:25",
            "userEmail" => "required|unique:users,email,".$request->id,
            "userPhone" => "required",
            "userAddress" => "required",
            "userImage" => "file|mimes : jpeg,jpg,png,webg",
        ])->validate();
    }

    // get user data

    private function getUserData($request){
        return [
            "name" => $request->userName,
            "email" => $request->userEmail,
            "phone" =>$request->userPhone,
            "address" => $request->userAddress,
            "gender" =>$request->userGender,
            "updated_at" =>Carbon::now(),
        ];
    }
    //password validation check


    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
           "oldPassword"  => "required|min:6|",
           "newPassword" => "required|min:6|different:oldPassword",
           "confirmPassword"  => "required|min:6|same:newPassword"
        ])->validate();
    }


}
