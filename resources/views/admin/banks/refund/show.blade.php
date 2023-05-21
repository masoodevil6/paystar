@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات درخواست استرداد")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">
            @php
                /**@var \App\Models\Banks\BankPaymentRefund $bankPaymentRefund*/
            @endphp
            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.banks.refund.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

                <div>
                    @if($bankPaymentRefund -> authority_num  != null)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-usd"
                            title='مشاهده تراکنش'
                            :url='route("admin.banks.payment.edit" , $bankPaymentRefund -> authority_num)'/>
                    @endif
                </div>

                <div>
                    @if($bankPaymentRefund -> order_id != null)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-shopping-cart"
                            title='مشاهده سفارش'
                            :url='route("admin.Orders.order.edit" , $bankPaymentRefund -> order_id)'/>
                    @endif
                </div>

            </section>


            @if(!empty($bankPaymentRefund->user))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات کاربر
                    </section>

                    <x-row-tables.admin.component-info-user
                        :user-id='$bankPaymentRefund -> user_id'
                        :user-full-name="$bankPaymentRefund -> user -> fullName"/>


                    <x-fields.component-row-data
                        title='نام کاربر'
                        :value='$bankPaymentRefund-> user -> fullName  '/>

                    <x-fields.component-row-data
                        title='شماره تماس'
                        :value='$bankPaymentRefund-> user -> phone  '/>

                    <x-fields.component-row-data
                        title='ایمیل'
                        :value='$bankPaymentRefund-> user -> email  '/>

                    <x-fields.component-row-data
                        title='زمان ثبت نام'
                        :value='jalaliDate($bankPaymentRefund-> user -> created_at)  '/>

                </section>
            @endif

            <section class="mt-5 border-bottom row p-0 m-0">

                <section class="col-12 gray-400 text-white text-center">
                    اطلاعات درخواست
                </section>

                <x-fields.component-row-data
                    title='وضعیت '
                    :value='($bankPaymentRefund->status)?"موفق":"ناموفق"'/>

                <x-fields.component-row-data
                    title='بانک'
                    :value='$bankPaymentRefund->bank_name'/>

                <x-fields.component-row-data
                    title='شماره رزرو'
                    :value='$bankPaymentRefund->res_num'/>

                <x-fields.component-row-data
                    title='شماره تراکنش'
                    :value='$bankPaymentRefund->ref_num'/>

                <x-fields.component-row-data
                    title='شماره authority'
                    :value='$bankPaymentRefund->authority_num'/>

                <x-fields.component-row-data
                    title='شماره تلفن'
                    :value='$bankPaymentRefund->mobile'/>

                <x-fields.component-row-data
                    title='ایمیل'
                    :value='$bankPaymentRefund->email'/>

                <x-fields.component-row-data
                    title='مبلغ'
                    :value='persianPriceFormat($bankPaymentRefund->amount)'/>

                <x-fields.component-row-data
                    title='توضیح تراکنش'
                    :value='$bankPaymentRefund->description'/>

            </section>

            @if($bankPaymentRefund->extra_data!=null && is_array($bankPaymentRefund->extra_data))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات اضافه
                    </section>

                    @foreach($bankPaymentRefund->extra_data as $key => $value)
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
