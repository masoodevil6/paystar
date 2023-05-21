@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات تراکنش ")


@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">
            @php
                /**@var \App\Models\Banks\BankPayment $bankPayment*/
            @endphp
            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.banks.payment.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

                <div>
                    @if($bankPayment -> is_status == true)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-undo"
                            title='استرداد وجه'
                            :url='route("admin.banks.payment.submit-refund" , $bankPayment -> authority_num)'/>
                    @endif
                </div>

                <div>

                    @if($bankPayment -> order_id != null)
                        <x-fields.component-button
                            btn-type='custom'
                            btn-icon="fa fa-shopping-cart"
                            title='مشاهده سفارش'
                            :url='route("admin.Orders.order.edit" , $bankPayment -> order_id)'/>
                    @endif

                    <x-fields.component-button
                        btn-type='custom'
                        btn-icon="fa fa-credit-card"
                        title='اعتبار سنجی تراکنش'
                        :url='route("admin.banks.payment.submit-verify" , $bankPayment -> authority_num)'/>

                </div>

            </section>


            @if(!empty($bankPayment->user))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات کاربر
                    </section>

                    <x-row-tables.admin.component-info-user
                        :user-id='$bankPayment -> user_id'
                        :user-full-name="$bankPayment -> user -> fullName"/>


                    <x-fields.component-row-data
                        title='نام کاربر'
                        :value='$bankPayment-> user -> fullName  '/>

                    <x-fields.component-row-data
                        title='شماره تماس'
                        :value='$bankPayment-> user -> phone  '/>

                    <x-fields.component-row-data
                        title='ایمیل'
                        :value='$bankPayment-> user -> email  '/>

                    <x-fields.component-row-data
                        title='زمان ثبت نام'
                        :value='jalaliDate($bankPayment-> user -> created_at)  '/>

                </section>
            @endif

            <section class="mt-5 border-bottom row p-0 m-0">

                <section class="col-12 gray-400 text-white text-center">
                    اطلاعات تراکنش
                </section>

                <x-fields.component-row-data
                    title='وضعیت کنونی'
                    :value='($bankPayment->active)?"اماده برای پرداخت":"ناتمام"'/>

                <x-fields.component-row-data
                    title='وضعیت پرداخت'
                    :value='($bankPayment->is_status)?"تراکنش موفق":"تراکنش ناموفق"'/>

                <x-fields.component-row-data
                    title='نوع'
                    :value='($bankPayment->is_test)?"تستی":"پرداختی"'/>

                <x-fields.component-row-data
                    title='بانک'
                    :value='$bankPayment->bank_name'/>

                <x-fields.component-row-data
                    title='کد وضعیت'
                    :value='$bankPayment->code'/>

                <x-fields.component-row-data
                    title='پیام نتیجه'
                    :value='$bankPayment->message'/>

                <x-fields.component-row-data
                    title='شماره رزرو'
                    :value='$bankPayment->Res_num'/>

                <x-fields.component-row-data
                    title='شماره authority'
                    :value='$bankPayment->authority_num'/>

                <x-fields.component-row-data
                    title='شماره تراکنش'
                    :value='$bankPayment->ref_num'/>

                <x-fields.component-row-data
                    title='شماره موبایل'
                    :value='$bankPayment->mobile'/>

                <x-fields.component-row-data
                    title='ایمیل'
                    :value='$bankPayment->email'/>

                <x-fields.component-row-data
                    title='مبلغ'
                    :value='persianPriceFormat($bankPayment->amount)'/>

                <x-fields.component-row-data
                    title='توضیح تراکنش'
                    :value='$bankPayment->description'/>

            </section>

            @if($bankPayment->extra_data!=null && is_array($bankPayment->extra_data))
                <section class="mt-5 border-bottom row p-0 m-0">

                    <section class="col-12 gray-400 text-white text-center">
                        اطلاعات اضافه
                    </section>

                    @foreach($bankPayment->extra_data as $key => $value)
                        <x-fields.component-row-data
                            :title='$key'
                            :value='$value'/>
                    @endforeach

                </section>
            @endif


            @if($bankPayment->text_admin!=null)
                <section class="mt-5 border-bottom row p-0 m-0">
                    <section class="col-12 gray-400 text-white text-center">
                        مارکر ادمین
                    </section>
                    <section class="col-12 gray-400 text-white text-center">
                        {{$bankPayment->text_admin}}
                    </section>
                </section>
            @endif


            <section class="mt-3 border-bottom">
                <section class="col-12 gray-400 text-white text-center">
                    اصلاح
                </section>
                <x-fields.component-from-data
                    :action='route("admin.banks.payment.update" , $bankPayment->authority_num )'>

                    <x-fields.component-select-options
                        title-en="is_status"
                        title-fa="تایین وضعیت تراکنش">

                        <option value="0" @if($bankPayment->is_status == false) selected @endif>
                            پرداخت نشده
                        </option>

                        <option value="1" @if($bankPayment->is_status == true) selected @endif>
                            پرداخت شده
                        </option>

                    </x-fields.component-select-options>


                    <section class="col-12 border border-dark rounded p-2 mx-1 my-2">
                        <x-fields.component-sk-editor
                            title-en="text_admin"
                            title-fa=" مارکر ادمین"
                            :value="$bankPayment->text_admin"
                            :ck-editor="0"/>
                    </section>

                </x-fields.component-from-data>

            </section>

        </section>
    </section>

@endsection


@section("footer-tag")

@endsection
