@extends("admin.layouts.master")
@section("titlePage" , "ادمین- نتیجه تست درگاه بانکی")


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
                    نتیجه تراکنش درگاه
                </section>


                <section class="col-6 mt-2 @if($resultPayment->isStatusPayment()) bg-success @else bg-danger @endif">

                    <p class="d-block text-white text-center py-1 font-size-12" style="background-color: grey">
                        نتیجه تراکنش
                    </p>

                    <p class="d-block text-center font-size-12 text-white">
                        {{$infoPayment->getStatusPayment()}}
                    </p>

                </section>


                <x-fields.component-row-data
                        title='پیام'
                        :value='$resultPayment->getFullMessage()'/>


                <x-fields.component-row-data
                        title='مبلغ'
                        :value='$resultPayment -> getAmount()  '/>

                <x-fields.component-row-data
                        title='موضوع'
                        :value='$resultPayment -> getDescription()  '/>


                <x-fields.component-row-data
                        title='شماره رزرو'
                        :value='$resultPayment -> getResNum()  '/>


                <x-fields.component-row-data
                        title='شماره تراکنش'
                        :value='$resultPayment -> getRefNum()  '/>


                <x-fields.component-row-data
                        title='نام درگاه'
                        :value='$resultPayment -> getPaymentName()  '/>

            </section>

        </section>
    </section>


@endsection


@section("footer-tag")

@endsection