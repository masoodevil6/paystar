<section class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

    <section class="bg-white rounded p-0 m-2">

        @if(!empty($codeOff) && $codeOff!=null && $codeOffPrice>0)

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        بن تخفیف
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$codeOff}}
                </section>
            </section>



            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        مبلغ بن تخفیف
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$codeOffPricePass}}
                </section>
            </section>

        @else
            <section class="py-2">
                <x-component-not-exist-item
                    title="کد تخفیفی اعمال نشده است"
                    :show-not-exist="false"
                />

            </section>
        @endif

    </section>

</section>
