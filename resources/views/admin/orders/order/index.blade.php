@extends("admin.layouts.master")
@section("titlePage" , "ادمین- لیست سفارشات")

@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="main-body-container-header">
                <h5>
                    لیست سفارشات
                </h5>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <div></div>


                <div class="mx-2 ">
                    <p class="text-center text-white font-size-12  bg-grey m-0 rounded">
                        فیلتر ها
                    </p>

                    <form action="{{ route("admin.Orders.order.index") }}" method="get" class=" border border-dark rounded p-1 d-flex">
                        <div class="d-block">
                            <div class="float-right mx-1">
                                <label for="filter-for-user" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    کاربر
                                </label>
                                <input name="user" id="filter-for-user" type="text" value="{{$userSearch}}" placeholder="جستجو ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-res" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    شماره رزرو سفارش
                                </label>
                                <input name="res" id="filter-for-res" type="text" value="{{$resNumSearch}}" placeholder="جستجو ..." class="form-control form-control-sm form-text">
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-is_finish" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    اشتراک
                                </label>
                                <select name="is_finish" id="filter-for-is_finish" class="form-control form-control-sm form-text">

                                    <option value="-1" @if($isFinishSearch==-1) selected @endif> همه </option>
                                    <option value="0" @if($isFinishSearch==0) selected @endif> تمام نشده </option>
                                    <option value="1" @if($isFinishSearch==1) selected @endif> اتمام یافته </option>

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
                        <th scope="col" class="w-15  font-size-12">شماره رزرو</th>
                        <th scope="col" class="w-15  font-size-12">کاربر</th>
                        <th scope="col" class="w-15  font-size-12">اتمام یافته</th>
                        <th scope="col" class="w-15  font-size-12">نتیجه اتمام</th>
                        <th scope="col" class="text-center  font-size-12">
                            <i class="fa fa-cogs"></i>
                            <span>تنظیمات</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders As $key => $itemOrder)
                        <x-row-tables.admin.component-item-order-admin
                            :order-key='($orders->currentPage() -1 )*$orders->perPage() + $key+1'
                            :order-id="$itemOrder -> id"
                            :order-res-num="$itemOrder -> res_num"
                            :order-user="$itemOrder -> user"
                            :order-is-finish="$itemOrder -> is_finish"
                            :order-description-finish="$itemOrder -> description_finish"/>
                    @endforeach
                    </tbody>

                </table>

            </section>

            <x-row-tables.admin.component-pageinate-panels
                :list="$orders"/>

        </section>
    </section>


@endsection

@section("footer-tag")

@endsection
