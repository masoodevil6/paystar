@extends("admin.layouts.master")
@section("titlePage" , "ادمین- ااطلاعات تراکتش Un-Verified ")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">
            @php
                /**@var \App\Models\Banks\BankPaymentUnVerify $bankPaymentUnVerified*/
            @endphp
            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.banks.un-verifies.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

                <div>
                    @if($bankPaymentUnVerified -> bank_payment_id  != null)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-usd"
                            title='مشاهده تراکنش'
                            :url='route("admin.banks.payment.edit" , $bankPaymentUnVerified -> bankPayment -> authority_num)'/>
                    @endif
                </div>

                <div>
                    @if($bankPaymentUnVerified -> order_id != null)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-shopping-cart"
                            title='مشاهده سفارش'
                            :url='route("admin.Orders.order.edit" , $bankPaymentUnVerified -> order_id)'/>
                    @endif
                </div>

            </section>


            @if(!empty($bankPaymentUnVerified->user))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات کاربر
                    </section>

                    <x-row-tables.admin.component-info-user
                        :user-id='$bankPaymentUnVerified -> user_id'
                        :user-full-name="$bankPaymentUnVerified -> user -> fullName"/>


                    <x-fields.component-row-data
                        title='نام کاربر'
                        :value='$bankPaymentUnVerified-> user -> fullName  '/>

                    <x-fields.component-row-data
                        title='شماره تماس'
                        :value='$bankPaymentUnVerified-> user -> phone  '/>

                    <x-fields.component-row-data
                        title='ایمیل'
                        :value='$bankPaymentUnVerified-> user -> email  '/>

                    <x-fields.component-row-data
                        title='زمان ثبت نام'
                        :value='jalaliDate($bankPaymentUnVerified-> user -> created_at)  '/>

                </section>
            @endif

            <section class="mt-5 border-bottom row p-0 m-0">

                <section class="col-12 gray-400 text-white text-center">
                    اطلاعات درخواست
                </section>

                <x-fields.component-row-data
                    title='وضعیت '
                    :value='($bankPaymentUnVerified->status)?"پایان یافته":"ناتمام"'/>

                <x-fields.component-row-data
                    title='بانک'
                    :value='$bankPaymentUnVerified->bank_name'/>

                <x-fields.component-row-data
                    title='شماره authority'
                    :value='$bankPaymentUnVerified->authority_num'/>

                <x-fields.component-row-data
                    title='تاریخ درخواست'
                    :value='jalaliDate($bankPaymentUnVerified->date_submit)'/>

                <x-fields.component-row-data
                    title='مبلغ'
                    :value='persianPriceFormat($bankPaymentUnVerified->amount)'/>

            </section>

            @if($bankPaymentUnVerified->extra_data!=null && is_array($bankPaymentUnVerified->extra_data))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات اضافه
                    </section>

                    @foreach($bankPaymentUnVerified->extra_data as $key => $value)
                        <x-fields.component-row-data
                            :title='$key'
                            :value='$value'/>
                    @endforeach

                </section>
            @endif

        </section>
    </section>

@endsection


@section("footer-tag")

@endsection
