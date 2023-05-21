<?php

use App\Http\Controllers\API\LoginApiController;
use App\Http\Controllers\API\Order\OrderBasketApiController;
use App\Http\Controllers\API\Order\OrderPaymentApiController;
use App\Http\Controllers\API\PublicApiController;
use App\Http\Controllers\API\User\UserOrderApiController;
use App\Http\Controllers\API\User\UserPersonApiController;
use Illuminate\Support\Facades\Route;


Route::controller(PublicApiController::class)->group(function (){

    Route::post("/subscribes" , "subscribes");

    Route::post("/subscribe/{subscribeSlug}" , "subscribe");

});



Route::prefix("login")->controller(LoginApiController::class)->group(function (){

    Route::middleware("throttle:check-last-login-client")
        ->post("/check-last-login" , "checkTokenAndEmail");

    Route::middleware("throttle:customer-login-register-limiter")
        ->post("/register" , "registerEmailOrPhoneClient");

    Route::middleware("throttle:customer-login-confirm-limiter")
        ->post("/confirm-login" , "ConfirmLoginClient");

    Route::middleware("throttle:customer-login-resend-limiter")
        ->post("/resend-otp-token" ,  "ResendMessageTokenClient");

});


Route::namespace("Order")->prefix("order")->group(function (){

    Route::prefix("/basket")
        ->controller(OrderBasketApiController::class)
        ->group(function (){

            Route::get("/get-list-basket/{cookie}" , "getListBasket");

            Route::post("/add-to-basket" , "addToBasket");

            Route::post("/delete-from-basket" , "deleteFromBasket");

        });


    Route::prefix("/payment")->controller(OrderPaymentApiController::class)->group(function (){

        Route::post("/get-list-banks" , "getListBanks");

        Route::post("/check-code-off" , "checkCodeOff")-> middleware("not.empty.basket.api");

        Route::post("/submit-request-payment" , "submitRequestPayment")->middleware(["auth:api" , "not.empty.basket.api"]);

        Route::post("/result" , "resultPayment")-> middleware("auth:api" );

    });


});



Route::namespace("User")->prefix("user")->middleware("auth:api")->group(function (){

    Route::prefix("person")->controller(UserPersonApiController::class)->group(function (){
        Route::post("info" , "getInfoClient");

        Route::post("set" , "setUserInfo");
    });

    Route::prefix("orders")->controller(UserOrderApiController::class)->group(function (){

        Route::post("/get-list-order" , "getListOrder");

        Route::post("/get-info-order" , "getInfoOrder");

    });

});






