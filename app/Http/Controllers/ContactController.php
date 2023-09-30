<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //admin

    //admin contact page

    public function adminContactPage(){
        $data = Contact::orderBy("created_at","desc")->get();
        return view("admin.contact.contactPage",compact("data"));
    }

    //contact detail

    public function contactDetail($id){
        $contact = Contact::where("id",$id)->first();
        return view("admin.contact.detail",compact("contact"));
    }





    //user

    //user contact page

    public function userContactPage(){
        return view("user.contact.contactPage");
    }

    //user contact message

    public function userMessage(Request $request){
        $data =$this->getMessageData($request);

        $this->messageValidation($request);
        Contact::create($data);

        return back()->with(["createSuccess"=>"Contact Message is created...."]);
    }


    //get contact data

    private function getMessageData($request){
        return [
            "name" => $request->userName,
            "phone"=> $request->userPhone,
            "email" => $request->userEmail,
            "message" => $request->userMessage,
            "created_at" => Carbon::now(),
        ];
    }


    //validate contact data

    private function messageValidation($request){
        Validator::make($request->all(),[
            "userName" => "required||min:5||max:15",
            "userPhone" => "required",
            "userEmail" => "required||email",
            "userMessage" => "required ||min:8||max:300",
        ])->validate();
    }
}
