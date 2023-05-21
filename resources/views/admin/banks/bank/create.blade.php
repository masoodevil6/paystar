@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات بانک")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.banks.bank.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

                @if(isset($bank["id"]) && $bank["id"] > 0)
                    <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-credit-card"
                            title='تست'
                            :url='route("admin.banks.bank.test-payment" , $bank -> id)'/>
                @endif

            </section>


            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                        :action='(isset($bank["id"]) && $bank["id"] > 0) ? route("admin.banks.bank.update" , $bank->id ) : route("admin.banks.bank.store" ) '
                        enctype="multipart/form-data">

                    @if(isset($bank["id"]) && $bank["id"] > 0)
                        @method("put")
                    @endif

                    <x-fields.component-input-insert
                            title-en="title"
                            title-fa="عنوان بانک"
                            :value="isset($bank['title']) ? $bank['title'] : ''" />

                    <x-fields.component-input-insert
                            title-en="merchant_id"
                            title-fa="کد اعتبارسنجی"
                            :value="isset($bank['merchant_id']) ? $bank['merchant_id'] : ''" />

                        <x-fields.component-select-options
                                title-en="service_name"
                                title-fa="کلاس درگاه">

                            <option disabled> کلاس درگاه مورد نظر را انتخاب نمایید </option>

                            @foreach($classes as $itemClass)
                                <option value="{{$itemClass->getName()}}" @if(isset($bank["class"]) && $itemClass->getClass()==$bank["class"]) selected @endif>
                                    {{$itemClass->getName()}}
                                </option>
                            @endforeach

                        </x-fields.component-select-options>



                        <section class="col-12 border border-dark rounded p-2 mx-1 my-2">
                            <x-fields.component-sk-editor
                                title-en="access_token"
                                title-fa="توکن دسترسی"
                                :value="isset($bank['access_token']) ? $bank['access_token'] : ''"
                                :ck-editor="0"/>
                        </section>


                        <x-fields.component-upload-image
                            title-en="image_file"
                            title-fa="تصویر"
                            :full="true">

                            @if(isset($bank["image_type"]) && $bank["image_type"] == 1 && isset($bank["image_location"]) && $bank["image_location"] != "")
                                <img class="d-block m-auto" src="{{asset($bank["image_location"])}}" height="150" alt="تصویر">
                            @endif

                        </x-fields.component-upload-image>




                    <x-fields.component-select-options
                            title-en="status"
                            title-fa="وضعیت">

                        <option value="0" @if(isset($bank["status"]) && $bank["status"]==0) selected @endif>غیر فعال </option>
                        <option value="1" @if(isset($bank["status"]) && $bank["status"]==1) selected @endif> فعال </option>

                    </x-fields.component-select-options>


                </x-fields.component-from-data>


            </section>

        </section>
    </section>


@endsection


@section("footer-tag")
    <script src="{{asset("public/js/vue.js")}}" ></script>
    <script>
        new Vue({
            el: "#image-type",
            data: {
                imageType: '@if(old("image_type")){{old("image_type")}}@elseif(isset($bank->image_type)){{$bank->image_type}}@else{{0}}@endif'
            },
            watch:{
                imageType: function (value) {
                    if (value < 0){
                        this.imageType =  0;
                    }
                    else if (value > 1){
                        this.imageType =  1;
                    }
                    else{
                        this.imageType = value;
                    }
                }
            }
        });
    </script>
@endsection
