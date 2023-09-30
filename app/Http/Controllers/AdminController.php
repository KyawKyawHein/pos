<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin account page

    public function accountPage(){

       return view("admin.account.editPage");
    }
    //admin account detail

    public function detail(){
        return view("admin.account.detail");
    }

    //admin account page update
    public function accountUpdate($id,Request $request){

       $this->ValidationCheck($request);
       $data = $this->getUserData($request);
       if($request->hasFile("userImage")){
        $dbImage = User::where("id",$id)->first();
        $dbImage = $dbImage->image;
        if($dbImage != null){
            Storage::delete("public/".$dbImage);
        }

        $filename = uniqid().$request->file("userImage")->getClientOriginalName();
        $request->file("userImage")->storeAs("public",$filename);
        $data["image"] =$filename;
       }
      User::where("id",$id)->update($data);
      return redirect()->route("admin#detail");
    }
    //password change page

    public function passwordChangePage(){
        return view("admin.account.changePassword");
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
           return redirect()->route("admin#passwordChangePage")->with(["Match" => "Password Changed Successfully"]);


        }else{
            return back()->with(["notMatch" => "Fail to Change Password"]);
        }
    }
    //admin list

    public function adminList(){
       $admin= User::where("role","admin")->paginate(4);
        return view("admin.account.adminList",compact("admin"));
    }

    //admin role change
    public function roleChange(Request $request){
        User::where("id",$request->id)->update([
            "role" => $request->role
        ]);
        return response()->json();
    }

    //admin delete

    public function adminDelete($id,Request $request){
       User::where("id",$id)->delete();
       return redirect()->route("admin#list");
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
