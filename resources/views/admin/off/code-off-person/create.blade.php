@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات کد تخفیف عمومی")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.offs.code-off-person.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

            </section>

            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                        :action='route("admin.offs.code-off-person.store" )'>

                        <x-fields.component-input-insert
                                title-en="min_price"
                                title-fa="حداقل مبلغ سفارش"
                                type="number"
                                value="" />

                        <x-fields.component-input-insert
                                title-en="off_price"
                                title-fa=" مبلغ تخفیف"
                                type="number"
                                value="" />

                        <x-fields.component-select-options
                                title-en="period"
                                title-fa="مدت تخفیف">

                            @for($i=1; $i<=365 ; $i++)
                                <option value="{{$i}}">
                                    {{$i}}
                                </option>
                            @endfor

                        </x-fields.component-select-options>


                    @include("admin.off.code-off-person.list-users")


                </x-fields.component-from-data>


            </section>

        </section>
    </section>


@endsection


@section("footer-tag")

@endsection


