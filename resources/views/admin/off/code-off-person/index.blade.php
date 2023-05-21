@extends("admin.layouts.master")
@section("titlePage" , "ادمین- لیست کدهای تخفیف شخصی")

@section("head-tag")

@endsection


@section("content")

    <section class="row p-0 m-0 ">
        <section class="main-body-container col-12 my-2 px-2 ">

            <section class="main-body-container-header">
                <h5>
                    لیست کدهای تخفیف شخصی
                </h5>
            </section>

            <section class="body-content d-flex justify-content-between pb-2 border-bottom">

                <div>
                    <a href="{{route("admin.offs.code-off-person.create")}}" class="btn btn-info btn-sm max-height-30">
                       کد تخفیف جدید
                    </a>
                </div>

                <div class="mx-2 ">
                    <p class="text-center text-white font-size-12  bg-grey m-0 rounded">
                        فیلتر ها
                    </p>

                    <form action="{{ route("admin.offs.code-off-person.index") }}" method="get" class=" border border-dark rounded p-1 d-flex">
                        <div class="d-block">

                            <div class="float-right mx-1">
                                <label for="filter-for-active" class="d-block text-right font-size-12 mt-2 mb-0 px-2 bg-grey">
                                    فعال
                                </label>
                                <select name="active" id="filter-for-active" class="form-control form-control-sm form-text">
                                    <option value=""> همه </option>
                                    <option value="0" @if($activeSearch==0) selected @endif> غیر فعال </option>
                                    <option value="1" @if($activeSearch==1) selected @endif> فعال </option>

                                </select>
                            </div>

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
                        <th scope="col" class="w-10  font-size-12">کد تخفیف</th>
                        <th scope="col" class="w-10  font-size-12">کاربر</th>
                        <th scope="col" class="w-10  font-size-12">حداقل مبلغ تراکنش</th>
                        <th scope="col" class="w-10  font-size-12">مبلغ تخفیف</th>
                        <th scope="col" class="w-10  font-size-12">زمان ساخت</th>
                        <th scope="col" class="w-10  font-size-12">مدت تخفیف</th>
                        <th scope="col" class="w-10  font-size-12">وضعیت</th>
                        <th scope="col" class="text-center  font-size-12">
                            <i class="fa fa-cogs"></i>
                            <span>تنظیمات</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($codeOffsPerson As $key => $itemCodeOffPerson)
                        <x-row-tables.admin.component-item-code-off-person
                                :code-off-person-key='($codeOffsPerson->currentPage() -1 )*$codeOffsPerson->perPage() + $key+1'
                                :code-off-person-id="$itemCodeOffPerson -> id"
                                :code-off-person-code="$itemCodeOffPerson -> code"
                                :code-off-person-user="(!empty($itemCodeOffPerson -> user)) ? $itemCodeOffPerson -> user -> fullName : 'null'"
                                :code-off-person-min-price="$itemCodeOffPerson -> min_price"
                                :code-off-person-off-price="$itemCodeOffPerson -> off_price"
                                :code-off-person-created-at="$itemCodeOffPerson -> created_at"
                                :code-off-person-period="$itemCodeOffPerson -> period"
                                :code-off-person-status="$itemCodeOffPerson -> status"/>
                    @endforeach
                    </tbody>

                </table>

            </section>

            <x-row-tables.admin.component-pageinate-panels
                    :list="$codeOffsPerson"/>

        </section>
    </section>


@endsection

@section("footer-tag")

@endsection