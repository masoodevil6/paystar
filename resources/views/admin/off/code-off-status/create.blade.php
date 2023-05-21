@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات شرط تولید کد تخفیف")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.offs.code-off-status.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

            </section>


            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                        :action='(isset($codeOffStatus["id"]) && $codeOffStatus["id"] > 0) ? route("admin.offs.code-off-status.update" , $codeOffStatus->id ) : route("admin.offs.code-off-status.store" )'>

                    @if(isset($codeOffStatus["id"]) && $codeOffStatus["id"] > 0)
                        @method("put")
                    @endif


                        <x-fields.component-input-insert
                                title-en="min_price"
                                title-fa="حداقل مبلغ سفارش"
                                type="number"
                                :value="isset($codeOffStatus['min_price']) ? $codeOffStatus['min_price'] : ''" />

                        <x-fields.component-input-insert
                                title-en="off_price"
                                title-fa=" مبلغ تخفیف"
                                type="number"
                                :value="isset($codeOffStatus['off_price']) ? $codeOffStatus['off_price'] : ''" />

                        <x-fields.component-select-options
                                title-en="period"
                                title-fa="مدت تخفیف">

                            @for($i=1; $i<=365 ; $i++)
                                <option value="{{$i}}" @if(isset($codeOffStatus["period"]) && $codeOffStatus["period"] == $i) selected @endif>
                                    {{$i}}
                                    روز
                                </option>
                            @endfor

                        </x-fields.component-select-options>

                        <x-fields.component-select-options
                                title-en="status"
                                title-fa="وضعیت">

                            <option value="0" @if(isset($codeOffStatus["status"]) && $codeOffStatus["status"]==0) selected @endif>غیر فعال </option>
                            <option value="1" @if(isset($codeOffStatus["status"]) && $codeOffStatus["status"]==1) selected @endif> فعال </option>

                        </x-fields.component-select-options>


                </x-fields.component-from-data>


            </section>

        </section>
    </section>


@endsection


@section("footer-tag")

@endsection


