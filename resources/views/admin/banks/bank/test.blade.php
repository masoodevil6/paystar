@extends("admin.layouts.master")
@section("titlePage" , "ادمین- تست درگاه بانکی")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.banks.bank.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

            </section>

            <section class="mt-5 border-bottom row p-0 m-0">

                <section class="col-12 gray-400 text-white text-center">
                    اطلاعات درگاه
                </section>

                <x-fields.component-row-data
                        title='نام درگاه'
                        :value='$bank->title'/>

                <x-fields.component-row-data
                        title='کلاس درگاه'
                        :value='$bank -> class  '/>

            </section>

            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                        :action='route("admin.banks.bank.test-submit")'>

                    <x-fields.component-input-insert
                            title-en="amount"
                            title-fa="مبلغ تراکنش"
                            type="number"
                            :value="10000" />

                    <x-fields.component-select-options
                            title-en="class_name"
                            title-fa="کلاس درگاه">

                        <option disabled> کلاس درگاه مورد نظر را انتخاب نمایید </option>

                        @foreach($classes as $itemClass)
                            <option value="{{$itemClass["name"]}}" @if(isset($bank["class"]) && $itemClass["class"]==$bank["class"]) selected @endif>
                                {{$itemClass["name"]}}
                            </option>
                        @endforeach

                    </x-fields.component-select-options>

                </x-fields.component-from-data>

            </section>

        </section>
    </section>


@endsection


@section("footer-tag")

@endsection