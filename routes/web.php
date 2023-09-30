<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//for login register
Route::middleware(["admin_auth"])->group(function(){
    Route::redirect("/","loginPage");
Route::get("loginPage",[AuthController::class,"loginPage"])->name("auth#loginPage");
Route::get("registerPage",[AuthController::class,"registerPage"])->name("auth#registerPage");
});

Route::middleware(["auth"])->group(function(){
    Route::get("dashboard",[AuthController::class,"dashboard"])->name("auth#dashboard");

    //for admin
    Route::middleware(["admin_auth"])->group(function(){
        Route::prefix("admin")->group(function(){
            Route::get("account",[AdminController::class,"accountPage"])->name("admin#editPage");
            Route::get("account/detail",[AdminController::class,"detail"])->name("admin#detail");
            Route::post("accountUpdate,{id}",[AdminController::class,"accountUpdate"])->name("admin#update");
            Route::get("passwordChangePage",[AdminController::class,"passwordChangePage"])->name("admin#passwordChangePage");
            Route::post("changePassword",[AdminController::class,"changePassword"])->name("admin#changePassword");
            Route::get("list",[AdminController::class,"adminList"])->name("admin#list");
            Route::get("list/change",[AdminController::class,"roleChange"])->name("admin#roleChange");
            Route::get("delete,{id}",[AdminController::class,"adminDelete"])->name("admin#delete");
        });


        //for category
        Route::prefix("category")->group(function(){
            Route::get("list",[CategoryController::class,"list"])->name("category#list");
            Route::get("create",[CategoryController::class,"categoryCreatePage"])->name("category#createPage");
            Route::post("createCategory",[CategoryController::class,"categoryCreate"])->name("category#create");
            Route::get("edit,{id}",[CategoryController::class,"categoryEditPage"])->name("category#editPage");
            Route::post("update",[CategoryController::class,"categoryUpdate"])->name("category#update");
            Route::get("delete,{id}",[CategoryController::class,"delete"])->name("category#delete");
        });

        //for product

        Route::prefix("product")->group(function(){
            Route::get("list",[ProductController::class,"list"])->name("product#list");
            Route::get("createPage",[ProductController::class,"createPage"])->name("product#createPage");
            Route::post("create",[ProductController::class,"create"])->name("product#create");
            Route::get("editPage,{id}",[ProductController::class,"editPage"])->name("product#editPage");
            Route::get("delete,{id}",[ProductController::class,"delete"])->name("product#delete");
            Route::post("update",[ProductController::class,"update"])->name("product#update");

        });
        //for order

        Route::prefix("order")->group(function(){
           Route::get("list",[OrderController::class,"adminOrderPage"])->name("admin#orderlist");
           Route::get("orderStatus",[OrderController::class,"orderStatus"])->name("order#orderStatus");
           Route::get("changeOrderStatus",[OrderController::class,"changeOrderStatus"])->name("order#changeOrderStatus");
           Route::get("detail/page,{id}",[OrderController::class,"adminOrderDetailPage"])->name("admin#orderDetail");
        });

        //contact

        Route::prefix("contact")->group(function(){
            Route::get("contactPage",[ContactController::class,"adminContactPage"])->name("admin#contactPage");
            Route::get("detail,{id}",[ContactController::class,"contactDetail"])->name("admin#contactDetail");
        });

    });




    Route::middleware(["user_auth"])->group(function(){
        Route::prefix("user")->group(function(){
            Route::get("home",[UserUserController::class,"list"])->name("user#home");
            Route::get("filter,{id}",[UserUserController::class,"filter"])->name("user#filter");
            Route::get("account",[UserUserController::class,"account"])->name("user#account");
            Route::get("editPage",[UserUserController::class,"editPage"])->name("user#editPage");
            Route::post("accountUpdate,{id}",[UserUserController::class,"accountUpdate"])->name("user#accountUpdate");
            Route::get("passwordChangePage",[UserUserController::class,"changePasswordPage"])->name("user#changePasswordPage");
            Route::post("changePassword",[UserUserController::class,"changePassword"])->name("user#changePassword");

        });
        Route::prefix("product")->group(function()
        {

            Route::get("detail,{id},{categoryId}",[ProductController::class,"detail"])->name("product#detail");
            Route::get("sortingList",[AjaxController::class,"productList"])->name("ajax#productList");

        });

        Route::prefix("cart")->group(function()
        {
            Route::get("addToCart",[AjaxController::class,"addToCart"])->name("ajax#addToCart");
            Route::get("cart/page",[CartController::class,"cartPage"])->name("cart#page");
            Route::get("removeBtn",[AjaxController::class,"removeBtn"])->name("ajax#removeBtn");
            Route::get("clearCartBtn",[AjaxController::class,"clearCartBtn"])->name("ajax#clearCartBtn");
            Route::get("checkoutBtn",[AjaxController::class,"checkoutBtn"])->name("ajax#checkoutBtn");

        });
        Route::prefix("order")->group(function(){
            Route::get("orderPage",[OrderController::class,"userOrderPage"])->name("order#userOrderPage");
            Route::get("orderDetailPage,{id}",[OrderController::class,"userOrderDetailPage"])->name("user#orderDetailPage");
        });

        Route::prefix("contact")->group(function(){
            Route::get("page",[ContactController::class,"userContactPage"])->name("user#contactPage");
            Route::post("createMessage",[ContactController::class,"userMessage"])->name("user#contactMessage");
        });
    });
});
