@extends("admin.layouts.master")
@section("titlePage" , "ادمین- لیست شروط تولید تخفیفات")

@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="main-body-container-header">
                <h5>
                    لیست شروط تولید تخفیفات
                </h5>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <div>
                    <a href="{{route("admin.offs.code-off-status.create")}}" class="btn btn-info btn-sm max-height-30">
                        شرط جدید
                    </a>
                </div>


                <div class="mx-2 ">
                    <p class="text-center text-white font-size-12  bg-grey m-0 rounded">
                        فیلتر ها
                    </p>

                    <form action="{{ route("admin.offs.code-off-status.index") }}" method="get" class=" border border-dark rounded p-1 d-flex">
                        <div class="d-block">

                            <div class="float-right mx-1">
                                <label for="filter-for-status" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    وضعیت
                                </label>
                                <select name="status" id="filter-for-status" class="form-control form-control-sm form-text">
                                    <option value=""> همه </option>
                                    <option value="0" @if($statusSearch==0) selected @endif> غیر فعال </option>
                                    <option value="1" @if($statusSearch==1) selected @endif> فعال </option>

                                </select>
                            </div>

                            <div class="float-right mx-1">
                                <label for="filter-for-order" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    مرتب سازی برحسب
                                </label>
                                <select name="order" id="filter-for-order" class="form-control form-control-sm form-text">
                                    <option value=""> همه </option>
                                    @foreach($orderByList As $itemListOrder)
                                        <option value="{{$itemListOrder["id"]}}" @if($orderSearch==$itemListOrder["id"]) selected @endif> {{$itemListOrder["title_fa"]}} </option>
                                    @endforeach
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
                        <th scope="col" class="w-25  font-size-12">حداقل مبلغ تراکنش</th>
                        <th scope="col" class="w-25  font-size-12">مبلغ تخفیف</th>
                        <th scope="col" class="w-15  font-size-12">مدت تخفیف</th>
                        <th scope="col" class="w-10  font-size-12">وضعیت</th>
                        <th scope="col" class="text-center  font-size-12">
                            <i class="fa fa-cogs"></i>
                            <span>تنظیمات</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($codeOffStatuses As $key => $itemCodeStatus)
                        <x-row-tables.admin.component-item-code-off-status
                                :code-off-status-key='($codeOffStatuses->currentPage() -1 )*$codeOffStatuses->perPage() + $key+1'
                                :code-off-status-id="$itemCodeStatus -> id"
                                :code-off-status-min-price="$itemCodeStatus -> min_price"
                                :code-off-status-off-price="$itemCodeStatus -> off_price"
                                :code-off-status-period="$itemCodeStatus -> period"
                                :code-off-status-status="$itemCodeStatus -> status"/>
                    @endforeach
                    </tbody>

                </table>

            </section>

            <x-row-tables.admin.component-pageinate-panels
                    :list="$codeOffStatuses"/>

        </section>
    </section>


@endsection

@section("footer-tag")

@endsection