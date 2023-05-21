@extends("admin.layouts.master")
@section("titlePage" , "ادمین- لیست تراکتش های Un-Verified")

@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="main-body-container-header">
                <h5>
                    لیست تراکتش های Un-Verified
                </h5>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <div></div>


                <div class="mx-2 ">
                    <p class="text-center text-white font-size-12  bg-grey m-0 rounded">
                        فیلتر ها
                    </p>

                    <form action="{{ route("admin.banks.un-verifies.index") }}" method="get" class=" border border-dark rounded p-1 d-flex">
                        <div class="d-block">

                            <div class="float-right mx-1">
                                <label for="filter-for-res_num" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره authority
                                </label>
                                <input name="res_num" id="filter-for-res_num" type="text" value="{{$resSearch}}" placeholder="جستجو شماره authority ..." class="form-control form-control-sm form-text">
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
                                    <option value="0" @if($statusSearch==0) selected @endif> ناتمام </option>
                                    <option value="1" @if($statusSearch==1) selected @endif> پایان یافته </option>

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
                        <th scope="col" class="w-15  font-size-12"> تراکنش</th>
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

                    @foreach($bankPaymentUnVerifies As $key => $itemBankPaymentUnVerified)

                        <x-row-tables.admin.component-item-bank-payment-un-verified
                            :bank-payment-un-verified-key='($bankPaymentUnVerifies->currentPage() -1 )*$bankPaymentUnVerifies->perPage() + $key+1'
                            :bank-payment-un-verified-authority="$itemBankPaymentUnVerified -> authority_num"
                            :bank-payment-un-verified-id="$itemBankPaymentUnVerified -> id"
                            :bank-payment-un-verified-bank-name="$itemBankPaymentUnVerified -> bank_name"
                            :bank-payment-un-verified-order-id="$itemBankPaymentUnVerified -> order_id"
                            :bank-payment-un-verified-order-res-num=" $itemBankPaymentUnVerified -> order"
                            :bank-payment-un-verified-status="$itemBankPaymentUnVerified -> status"
                            :bank-payment-un-verified-bank-payment-id="$itemBankPaymentUnVerified -> bank_payment_id"
                            :bank-payment-un-verified-user-full-name="$itemBankPaymentUnVerified -> user "/>
                    @endforeach
                    </tbody>

                </table>

            </section>

            <x-row-tables.admin.component-pageinate-panels
                :list="$bankPaymentUnVerifies"/>

        </section>
    </section>


@endsection

@section("footer-tag")

@endsection
