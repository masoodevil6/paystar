@extends("admin.layouts.master")
@section("titlePage" , "ادمین- لیست درخواست های استرداد")

@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="main-body-container-header">
                <h5>
                    لیست درخواست های استرداد
                </h5>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <div></div>


                <div class="mx-2 ">
                    <p class="text-center text-white font-size-12  bg-grey m-0 rounded">
                        فیلتر ها
                    </p>

                    <form action="{{ route("admin.banks.refund.index") }}" method="get" class=" border border-dark rounded p-1 d-flex">
                        <div class="d-block">

                            <div class="float-right mx-1">
                                <label for="filter-for-res_num" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره رزرو
                                </label>
                                <input name="res_num" id="filter-for-res_num" type="text" value="{{$resSearch}}" placeholder="جستجو شماره رزرو ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-ref_num" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره تراکنش
                                </label>
                                <input name="ref_num" id="filter-for-ref_num" type="text" value="{{$refSearch}}" placeholder="جستجو شماره تراکنش ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-authority_num" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره authority
                                </label>
                                <input name="authority_num" id="filter-for-authority_num" type="text" value="{{$authoritySearch}}" placeholder="جستجو شماره authority ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-bank" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    بانک
                                </label>
                                <select name="bank" id="filter-for-bank" class="form-control form-control-sm form-text">

                                    <option value @if($bankSearch==0) selected @endif> همه </option>

                                    @php
                                        /**@var \App\Models\Banks\Bank $itemBank*/
                                    @endphp
                                    @foreach($banks as $itemBank)
                                        <option value="{{$itemBank->class_name}}" @if($itemBank->class_name==$bankSearch) selected @endif> {{$itemBank->title}} </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-user" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    کاربر
                                </label>
                                <input name="user" id="filter-for-user" type="text" value="{{$userSearch}}" placeholder="جستجو کاربر ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-res_num_order" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره رزرو سفارش
                                </label>
                                <input name="res_num_order" id="filter-for-res_num_order" type="text" value="{{$resOrderSearch}}" placeholder="جستجو سفارش..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-status" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    وضعیت
                                </label>
                                <select name="status" id="filter-for-status" class="form-control form-control-sm form-text">

                                    <option value="-1" @if($statusSearch==-1) selected @endif> همه </option>
                                    <option value="0" @if($statusSearch==0) selected @endif> ناموفق </option>
                                    <option value="1" @if($statusSearch==1) selected @endif> موفق </option>

                                </select>
                            </div>
                        </div>


                        <button type="submit"  class="btn btn-info round float-left font-size-md mt-1">
                            <i class="fa fa-search"></i>
                            جستجو
                        </button>
                    </form>

                </div>

            </section>

            <section id="table-list-products" class="table-responsive">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="w-15  font-size-12">کاربر</th>
                        <th scope="col" class="w-15  font-size-12">شماره رزرو</th>
                        <th scope="col" class="w-15  font-size-12">شماره تراکنش</th>
                        <th scope="col" class="w-15  font-size-12">تراکنش</th>
                        <th scope="col" class="w-15  font-size-12">بانک</th>
                        <th scope="col" class="w-15  font-size-12">شماره سفارش</th>
                        <th scope="col" class="w-15  font-size-12">وضعیت</th>
                        <th scope="col" class="text-center  font-size-12">
                            <i class="fa fa-cogs"></i>
                            <span>تنظیمات</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($bankPaymentRefunds As $key => $itemBankPaymentRefund)
                        <x-row-tables.admin.component-item-bank-payment-refund
                            :bank-payment-refund-key='($bankPaymentRefunds->currentPage() -1 )*$bankPaymentRefunds->perPage() + $key+1'
                            :bank-payment-refund-id="$itemBankPaymentRefund -> id"
                            :bank-payment-refund-res-num="$itemBankPaymentRefund -> res_num"
                            :bank-payment-refund-ref-num="$itemBankPaymentRefund -> ref_num"
                            :bank-payment-refund-authority="$itemBankPaymentRefund -> authority_num"
                            :bank-payment-refund-bank-name="$itemBankPaymentRefund -> bank_name"
                            :bank-payment-refund-order-id="$itemBankPaymentRefund -> order_id"
                            :bank-payment-refund-order-res-num=" $itemBankPaymentRefund -> order"
                            :bank-payment-refund-status="$itemBankPaymentRefund -> status"
                            :bank-payment-refund-bank-payment-id="$itemBankPaymentRefund -> bank_payment_id"
                            :bank-payment-refund-user-full-name="$itemBankPaymentRefund -> user "/>
                    @endforeach
                    </tbody>

                </table>

            </section>

            <x-row-tables.admin.component-pageinate-panels
                :list="$bankPaymentRefunds"/>

        </section>
    </section>


@endsection

@section("footer-tag")

@endsection
