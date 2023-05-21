@extends("admin.layouts.master")
@section("titlePage" , "ادمین- اطلاعات فرم")

@section("head-tag")

@endsection

@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <a href="{{route("admin.Orders.order.index")}}" class="btn btn-info btn-sm">
                    بازگشت
                </a>

                <a href="{{route("admin.banks.payment.index" , ["user" => $orderInfo->getUserFullName() , "res_num_order" => $orderInfo->getOrderResNum() , "is_test" =>0])}}" class="btn btn-success btn-sm">
                    تراکنش ها
                </a>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <x-row-tables.admin.component-info-user
                    :user-id='$orderInfo->getUserId()'
                    :user-full-name="$orderInfo->getUserFullName()"/>

            </section>


            <x-component-info-order
                :order-info="$orderInfo"
                :show-status-submitted="true"/>

            <section class="mt-3 border-bottom">

                <x-fields.component-from-data
                    :action='route("admin.Orders.order.update" , $orderInfo->getOrder()->id )'>

                    <x-fields.component-sk-editor
                        title-en="description_finish"
                        title-fa="دلیل اتمام"
                        :value="$orderInfo->getOrder()->description_finish"
                        :ck-editor="0"/>

                    <x-fields.component-select-options
                        title-en="is_finish"
                        title-fa="اتمام یافته">

                        <option value="0" @if($orderInfo->getOrder()->is_finish == 0) selected @endif>خیر</option>
                        <option value="1" @if($orderInfo->getOrder()->is_finish == 1) selected @endif>بله</option>

                    </x-fields.component-select-options>

                </x-fields.component-from-data>

            </section>

        </section>
    </section>

@endsection


@section("footer-tag")

@endsection


