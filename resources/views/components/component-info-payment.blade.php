<section class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

    <section class="bg-white rounded p-0 m-2">

        <section class="row border round m-0 p-0">

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border   border-white @if($infoPayment->isStatusPayment()) bg-success @else bg-danger @endif">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        نتیجه تراکنش
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center text-white ">
                    {{$infoPayment->getStatusPayment()}}
                </section>
            </section>


            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        پیام
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getFullMessage()}}
                </section>
            </section>


            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        مبلغ
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getAmount()}}
                </section>
            </section>



            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        موضوع
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getDescription()}}
                </section>
            </section>



            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        شماره رزرو
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getResNum()}}
                </section>
            </section>



            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        شماره تراکنش
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getRefNum()}}
                </section>
            </section>



            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        نام درگاه
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{$infoPayment->getPaymentName()}}
                </section>
            </section>


        </section>

    </section>

</section>
