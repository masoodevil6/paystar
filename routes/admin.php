<?php

use App\Http\Controllers\Admin\Banks\BackAdminController;
use App\Http\Controllers\Admin\Banks\BankPaymentAdminController;
use App\Http\Controllers\Admin\Banks\BankPaymentRefundAdminController;
use App\Http\Controllers\Admin\Banks\BankPaymentUnVerifiedAdminController;
use App\Http\Controllers\Admin\Offs\CodeOffPersonAdminController;
use App\Http\Controllers\Admin\Offs\CodeOffPublicAdminController;
use App\Http\Controllers\Admin\Offs\CodeOffStatusAdminController;
use App\Http\Controllers\Admin\Orders\OrderAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Home\HomeAdminController;
use App\Http\Controllers\Admin\Panel\PanelAdminController;
use App\Http\Controllers\Admin\Panel\UserAdminController;
use App\Http\Controllers\Admin\Publics\PublicSettingAdminController;
use App\Http\Controllers\Admin\Subscribes\SubscribesAdminController;
use App\Http\Controllers\Admin\Subscribes\SubscribePaymentsAdminController;
use App\Http\Controllers\Admin\Users\UserController;





/// =================================================
/// Home Page Admin
/// =================================================
Route::namespace("Home")->group(function (){

    Route::prefix("home")->controller(HomeAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.home");

    });

});




/// =================================================
/// admin Panel
/// =================================================

Route::namespace("Panel")->group(function (){

    Route::prefix("admin")->controller(PanelAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.panel.admin.index");

        Route::get("/create" , "create")->name("admin.panel.admin.create");
        Route::post("/store" , "store")->name("admin.panel.admin.store");

        Route::get("/edit/{admin}" , "edit")->name("admin.panel.admin.edit");
        Route::post("/update/{admin}" , "update")->name("admin.panel.admin.update");

        Route::get("/panels/{admin}" , "panels")->name("admin.panel.admin.panels");
        Route::post("/store-panels/{admin}" , "storePanels")->name("admin.panel.admin.storePanels");

        Route::delete("/destroy/{admin}" ,  "destroy")->name("admin.panel.admin.destroy");

        Route::post("/status/{admin}" , "status")->name("admin.panel.admin.status");
    });

    Route::prefix("user-admin")->controller(UserAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.panel.user-admin.index");

        Route::get("/create" , "create")->name("admin.panel.user-admin.create");
        Route::post("/store" , "store")->name("admin.panel.user-admin.store");

        Route::get("/edit/{user:email}" , "edit")->name("admin.panel.user-admin.edit");
        Route::put("/update/{user:email}" , "update")->name("admin.panel.user-admin.update");

        Route::delete("/destroy/{user:email}" ,  "destroy")->name("admin.panel.user-admin.destroy");

        Route::post("/status/{user:email}" , "status")->name("admin.panel.user-admin.status");
    });
});





/// =================================================
/// public setting
/// =================================================

Route::namespace("Publics")->group(function (){

    Route::prefix("setting")->controller(PublicSettingAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.public.setting.index");
        Route::post("/update" , "update")->name("admin.public.setting.update");

    });



});



/// =================================================
/// user panel
/// =================================================

Route::namespace("Users")->group(function (){

    Route::prefix("user")->controller(UserController::class)->group(function (){

        Route::get("/" , "index")->name("admin.users.user.index");

        Route::get("/show/{user}" , "show")->name("admin.users.user.show");
        Route::post("/update/{user}" , "changeInfo")->name("admin.users.user.change-info");

        Route::post("/status/{user}" , "status")->name("admin.users.user.status");

    });


});








/// =================================================
/// bank panel
/// =================================================

Route::namespace("Banks")->group(function (){


    Route::prefix("banks")->controller(BackAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.banks.bank.index");

        Route::get("/create" , "create")->name("admin.banks.bank.create");
        Route::post("/store" , "store")->name("admin.banks.bank.store");

        Route::get("/edit/{bank}" , "edit")->name("admin.banks.bank.edit");
        Route::put("/update/{bank}" , "update")->name("admin.banks.bank.update");

        Route::delete("/destroy/{bank}" ,  "destroy")->name("admin.banks.bank.destroy");

        Route::post("/status/{bank}" , "status")->name("admin.banks.bank.status");

        Route::get("/test/{bank}" , "testPayment")->name("admin.banks.bank.test-payment");
        Route::post("/test-submit" , "submitTestPayment")->name("admin.banks.bank.test-submit");
        Route::get("/test-result/{bankName}" , "resultTestPayment")->name("admin.banks.bank.test-result");
    });


    Route::prefix("payments")->controller(BankPaymentAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.banks.payment.index");

        Route::get("/show/{bankPaymentAuthorityNum}" , "edit")->name("admin.banks.payment.edit");
        Route::post("/update/{bankPaymentAuthorityNum}" , "update")->name("admin.banks.payment.update");
        Route::get("/submit-verify/{bankPaymentAuthorityNum}" , "submitVerify")->name("admin.banks.payment.submit-verify");
        Route::get("/submit-refund/{bankPaymentAuthorityNum}" , "submitRefund")->name("admin.banks.payment.submit-refund");

        Route::delete("/destroy/{bankPaymentAuthorityNum}" ,  "destroy")->name("admin.banks.payment.destroy");
    });


    Route::prefix("un-verifies")->controller(BankPaymentUnVerifiedAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.banks.un-verifies.index");

        Route::get("/show/{bankPaymentUnVerified}" , "show")->name("admin.banks.un-verifies.show");

        Route::delete("/destroy/{bankPaymentUnVerified}" ,  "destroy")->name("admin.banks.un-verifies.destroy");
    });


    Route::prefix("refunds")->controller(BankPaymentRefundAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.banks.refund.index");

        Route::get("/show/{bankPaymentRefund}" , "show")->name("admin.banks.refund.show");

        Route::delete("/destroy/{bankPaymentRefund}" ,  "destroy")->name("admin.banks.refund.destroy");
    });

});





/// =================================================
/// order panel
/// =================================================

Route::namespace("Orders")->group(function (){

    Route::prefix("orders")->controller(OrderAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.Orders.order.index");

        Route::get("/show/{order}" , "edit")->name("admin.Orders.order.edit");
        Route::post("/update/{order}" , "update")->name("admin.Orders.order.update");

        Route::delete("/destroy/{order}" ,  "destroy")->name("admin.Orders.order.destroy");
    });

});









/// =================================================
/// Subscribes panel
/// =================================================

Route::namespace("Subscribes")->group(function (){

    Route::prefix("subscribes")->controller(SubscribesAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.subscribes.subscribe.index");

        Route::get("/create" , "create")->name("admin.subscribes.subscribe.create");
        Route::post("/store" , "store")->name("admin.subscribes.subscribe.store");

        Route::get("/edit/{subscribe}" , "edit")->name("admin.subscribes.subscribe.edit");
        Route::put("/update/{subscribe}" , "update")->name("admin.subscribes.subscribe.update");

        Route::delete("/destroy/{subscribe}" ,  "destroy")->name("admin.subscribes.subscribe.destroy");

        Route::post("/status/{subscribe}" , "status")->name("admin.subscribes.subscribe.status");

        Route::post("/selected/{subscribe}" , "selected")->name("admin.subscribes.subscribe.selected");

    });

    Route::prefix("subscribe_payments")->controller(SubscribePaymentsAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.subscribes.subscribe-payment.index");

        Route::get("/show/{subscribePayment}" , "show")->name("admin.subscribes.subscribe-payment.show");

        Route::get("/create" , "create")->name("admin.subscribes.subscribe-payment.create");
        Route::post("/store" , "store")->name("admin.subscribes.subscribe-payment.store");

        Route::get("/edit/{subscribePayment}" , "edit")->name("admin.subscribes.subscribe-payment.edit");
        Route::put("/update/{subscribePayment}" , "update")->name("admin.subscribes.subscribe-payment.update");

        Route::delete("/destroy/{subscribePayment}" ,  "destroy")->name("admin.subscribes.subscribe-payment.destroy");

    });

});






/// =================================================
/// Off Page Admin
/// =================================================

Route::namespace("Offs")->group(function (){

    Route::prefix("code-off-status")->controller(CodeOffStatusAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.offs.code-off-status.index");

        Route::get("/create" , "create")->name("admin.offs.code-off-status.create");
        Route::post("/store" , "store")->name("admin.offs.code-off-status.store");

        Route::get("/edit/{codeOffStatus}" , "edit")->name("admin.offs.code-off-status.edit");
        Route::put("/update/{codeOffStatus}" , "update")->name("admin.offs.code-off-status.update");

        Route::delete("/destroy/{codeOffStatus}" ,  "destroy")->name("admin.offs.code-off-status.destroy");
        Route::post("/status/{codeOffStatus}" , "status")->name("admin.offs.code-off-status.status");
    });


    Route::prefix("code-off-public")->controller(CodeOffPublicAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.offs.code-off-public.index");

        Route::get("/create" , "create")->name("admin.offs.code-off-public.create");
        Route::post("/store" , "store")->name("admin.offs.code-off-public.store");

        Route::get("/edit/{codeOffId}" , "edit")->name("admin.offs.code-off-public.edit");
        Route::put("/update/{codeOffId}" , "update")->name("admin.offs.code-off-public.update");

        Route::delete("/destroy/{codeOffId}" ,  "destroy")->name("admin.offs.code-off-public.destroy");
        Route::post("/status/{codeOffId}" , "status")->name("admin.offs.code-off-public.status");
    });


    Route::prefix("code-off-person")->controller(CodeOffPersonAdminController::class)->group(function (){

        Route::get("/" , "index")->name("admin.offs.code-off-person.index");

        Route::get("/create" , "create")->name("admin.offs.code-off-person.create");
        Route::post("/store" , "store")->name("admin.offs.code-off-person.store");

        Route::post("/search-users" , "searchUsers")->name("admin.offs.code-off-person.search-users");

        Route::delete("/destroy/{codeOffId}" ,  "destroy")->name("admin.offs.code-off-person.destroy");
        Route::post("/status/{codeOffId}" , "status")->name("admin.offs.code-off-person.status");
    });

});

