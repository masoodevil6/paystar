var formListUserOrder =$("#form-list-user-order");
var formShowUserOrder =$("#form-show-user-order");

function selectUserOrderInfo(userOrderResNum) {
    var data= {
        "user_order_res_num" : userOrderResNum ,
        "_token": $('meta[name="csrf-token-customer-panel"]').attr('content')
    };
    var loading =  $("body").loadingAjax();
    $.ajax({
        url: $('meta[name="url-get-info-user-order"]').attr('content'),
        type: "POST",
        data: data,
        beforeSend: function () {
            loading.start();
        },
        success: function (result) {
            formShowUserOrder.html(result);
            goToFormShowOrderClient();
        },
        complete: function () {
            loading.end();
        }
    });
}


function goBackFromShowOrderClient() {
    formListUserOrder.removeClass("d-none");
    formShowUserOrder.addClass("d-none");
}

function goToFormShowOrderClient() {
    formListUserOrder.addClass("d-none");
    formShowUserOrder.removeClass("d-none");
}


function goBackInfoOrderClient() {
    $("#form-info-user-order").removeClass("d-none");
    $("#form-info-user-payment").addClass("d-none");
}

function goToInfoOrderPaymentClient() {
    $("#form-info-user-order").addClass("d-none");
    $("#form-info-user-payment").removeClass("d-none");
}