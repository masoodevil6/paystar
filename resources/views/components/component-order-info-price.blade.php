<section class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

    <section class="bg-white rounded p-0 m-2">

        <section class="row border round m-0 p-0">

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        مبلغ سفارش
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoOrderPrice->getRealPriceTextPass()}}
                </section>
            </section>

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        تخفیف
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoOrderPrice->getOffPriceTextPass()}}
                </section>
            </section>

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border blue-gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block blue-gray-200 rounded font-weight-bold text-center mx-2">
                        مبلغ قابل پرداخت
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoOrderPrice->getTotalPriceTextPass()}}
                </section>
            </section>

        </section>

    </section>

</section>
