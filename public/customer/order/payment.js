var app =
    new Vue({
        el: "#app",
        data: {
            codeOff: "" ,
            showResult: false ,
            resultBackground: "bg-danger" ,
            resultText: "" ,

            className: ""
        },
        methods:{
            checkCodeOff:function () {
                if (!this.codeOff.trim().length || this.codeOff == null){
                    app.showAsError("فیلد مربوطه خالی می باشد")
                }
                else {
                    var dataJson= {
                        "code_off": this.codeOff ,
                        "_token":  $('meta[name="csrf-token"]').attr('content')
                    };
                    var loading =  $("body").loadingAjax();
                    $.ajax({
                        url: $('meta[name="url-check-code-off"]').attr('content') ,
                        method: "POST",
                        data: dataJson,
                        beforeSend: function () {
                            loading.start();
                        },
                        success: function (result) {
                            app.setShowResult();
                            app.setResultText(result["title"]);
                            app.setResultBacground(result["status"]);
                        },
                        complete: function () {
                            loading.end();
                        },
                        dataType: "json"
                    });
                }
            } ,


            showAsError:function (msg) {
                app.setShowResult();
                app.setResultText(msg);
                app.setResultBacground(false)
            } ,

            setShowResult: function(){
                this.showResult = true;
            },
            setResultText: function(msg){
                this.resultText = msg;
            },
            setResultBacground: function (status) {
                if(status){
                    this.resultBackground = "bg-success";
                }
                else{
                    this.resultBackground = "bg-danger";
                }
            }
        }
    });

var items = $(".item-payment");
if (items.length > 0){
    items.eq(0).trigger("click");
}



