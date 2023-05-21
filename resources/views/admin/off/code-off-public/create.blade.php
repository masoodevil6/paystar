@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات کد تخفیف عمومی")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.offs.code-off-public.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

            </section>


            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                        :action='(isset($codeOffPublic["id"]) && $codeOffPublic["id"] > 0) ? route("admin.offs.code-off-public.update" , $codeOffPublic->id ) : route("admin.offs.code-off-public.store" )'
                        enctype="multipart/form-data">

                    @if(isset($codeOffPublic["id"]) && $codeOffPublic["id"] > 0)
                        @method("put")
                    @endif

                        <x-fields.component-input-insert
                                title-en="code"
                                title-fa="کد تخفیف"
                                :value="isset($codeOffPublic['code']) ? $codeOffPublic['code'] : ''" />

                        <x-fields.component-input-insert
                                title-en="min_price"
                                title-fa="حداقل مبلغ سفارش"
                                type="number"
                                :value="isset($codeOffPublic['min_price']) ? $codeOffPublic['min_price'] : ''" />

                        <x-fields.component-input-insert
                                title-en="off_price"
                                title-fa=" مبلغ تخفیف"
                                type="number"
                                :value="isset($codeOffPublic['off_price']) ? $codeOffPublic['off_price'] : ''" />

                        <x-fields.component-select-options
                                title-en="period"
                                title-fa="مدت تخفیف">

                            @for($i=1; $i<=365 ; $i++)
                                <option value="{{$i}}" @if(isset($codeOffPublic["period"]) && $codeOffPublic["period"] == $i) selected @endif>
                                    {{$i}}
                                </option>
                            @endfor

                        </x-fields.component-select-options>

                        <x-fields.component-select-options
                                title-en="status"
                                title-fa="وضعیت">

                            <option value="0" @if(isset($codeOffPublic["status"]) && $codeOffPublic["status"]==0) selected @endif>غیر فعال </option>
                            <option value="1" @if(isset($codeOffPublic["status"]) && $codeOffPublic["status"]==1) selected @endif> فعال </option>

                        </x-fields.component-select-options>

                        <x-fields.component-upload-image
                                title-en="image_file"
                                title-fa="تصویر" >

                            @if(isset($codeOffPublic["image"]) && $codeOffPublic["image"] != "")
                                <img class="d-block m-auto" src="{{asset($codeOffPublic["image"])}}" height="150" alt="تصویر">
                            @endif

                        </x-fields.component-upload-image>


                </x-fields.component-from-data>


            </section>

        </section>
    </section>


@endsection


@section("footer-tag")

@endsection


