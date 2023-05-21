<template>

    <section id="form-nav-basket" class=" p-0 rounded mt-2 form-shadow">

        <section class="m-2 row">

            <section class="col-lg-12 bg-white rounded p-0 mx-2 mt-2 m-lg-0 row">

                <section class=" col-lg-12  p-0 mx-2 mt-2 m-lg-0 row py-2">

                    <section class=" col-lg-3 px-0 py-0 py-lg-2">

                        <i v-bind:class="step >=1 ? 'text-info' : 'text-dark'"  class="icon-item-navigation-basket  fa fa-shopping-cart d-lg-block float-right float-lg-none  text-center font-size-xxlg mr-4 m-lg-0 py-2 py-lg-0"></i>
                        <span v-bind:class="step >=1 ? 'text-info' : 'text-dark'" class="text-item-navigation-basket text-right text-lg-center d-lg-block float-right float-lg-none  font-size-lg mt-1 mb-0 mr-2  mt-lg-2 py-2 py-lg-0 font-weight-bold">
                            سبد خرید
                        </span>
                        <section class="section-line-navigation-basket float-right float-lg-none  position-relative d-block m-0 my-lg-1">
                            <section v-bind:class="step >=2 ? 'bg-info' : 'bg-dark'"  class="vertical-line-navigation-basket rounded position-absolute "></section>
                            <section v-bind:class="step >=2 ? 'bg-info' : 'bg-dark'" class="left-horizontal-line-navigation-basket rounded position-absolute "></section>
                        </section>

                    </section>


                    <section class=" col-lg-3 px-0 py-0 py-lg-2">
                        <i v-bind:class="step >=2 ? 'text-info' : 'text-dark'"  class="icon-item-navigation-basket  fa fa-sign-in d-lg-block float-right float-lg-none   text-center font-size-xxlg mr-4 m-lg-0 py-2 py-lg-0"></i>
                        <span  v-bind:class="step >=2 ? 'text-info' : 'text-dark'"  class="text-item-navigation-basket text-right text-lg-center d-lg-block float-right float-lg-none  font-size-lg mt-1 mb-0 mr-2  mt-lg-2 py-2 py-lg-0 font-weight-bold">
                            ورود
                        </span>
                        <section class="section-line-navigation-basket float-right float-lg-none position-relative d-block m-0 my-lg-1">
                            <section v-bind:class="step >=2 ? 'bg-info' : 'bg-dark'" class="vertical-line-navigation-basket rounded position-absolute "></section>
                            <section v-bind:class="step >=2 ? 'bg-info' : 'bg-dark'" class="right-horizontal-line-navigation-basket rounded position-absolute "></section>
                            <section v-bind:class="step >=3 ? 'bg-info' : 'bg-dark'" class="left-horizontal-line-navigation-basket  rounded position-absolute "></section>
                        </section>

                    </section>


                    <section class=" col-lg-3 px-0 py-0 py-lg-2">
                        <i  v-bind:class="step >=3 ? 'text-info' : 'text-dark'"  class="icon-item-navigation-basket  fa fa-credit-card-alt d-lg-block float-right float-lg-none   text-center font-size-xxlg mr-4 m-lg-0 py-2 py-lg-0"></i>
                        <span v-bind:class="step >=3 ? 'text-info' : 'text-dark'"  class="text-item-navigation-basket text-right text-lg-center d-lg-block float-right float-lg-none  font-size-lg mt-1 mb-0 mr-2  mt-lg-2 py-2 py-lg-0 font-weight-bold">
                            پرداخت
                        </span>
                        <section class="section-line-navigation-basket float-right float-lg-none  position-relative d-block m-0 my-lg-1">
                            <section v-bind:class="step >=3 ? 'bg-info' : 'bg-dark'" class="vertical-line-navigation-basket rounded position-absolute "></section>
                            <section v-bind:class="step >=3 ? 'bg-info' : 'bg-dark'" class="right-horizontal-line-navigation-basket rounded  position-absolute "></section>
                            <section v-bind:class="step >=4 ? 'bg-info' : 'bg-dark'" class="left-horizontal-line-navigation-basket rounded position-absolute "></section>
                        </section>

                    </section>

                    <section class=" col-lg-3 px-0 py-0 py-lg-2">
                        <i v-bind:class="step >=4 ? 'text-info' : 'text-dark'" class="icon-item-navigation-basket  fa fa-check-circle d-lg-block float-right float-lg-none  text-center font-size-xxlg mr-4 m-lg-0 py-2 py-lg-0"></i>
                        <span v-bind:class="step >=4 ? 'text-info' : 'text-dark'" class="text-item-navigation-basket text-right text-lg-center d-lg-block float-right float-lg-none  font-size-lg mt-1 mb-0 mr-2  mt-lg-2 py-2 py-lg-0 font-weight-bold">
                            نتیجه
                        </span>
                        <section class="section-line-navigation-basket float-right float-lg-none  position-relative d-block m-0 my-lg-1">
                            <section  v-bind:class="step >=4 ? 'bg-info' : 'bg-dark'"  class="vertical-line-navigation-basket rounded position-absolute "></section>
                            <section  v-bind:class="step >=4 ? 'bg-info' : 'bg-dark'"  class="right-horizontal-line-navigation-basket  rounded position-absolute "></section>
                        </section>

                    </section>


                </section>


            </section>


        </section>


    </section>

</template>

<script>

export default {
    props:["step"]
}

</script>


<style>
@media (max-width: 992px) {

    .text-item-navigation-basket{
        width: 100px;
    }

    .section-line-navigation-basket{
        width: 80px;
        height: 100%;
    }

    .icon-item-navigation-basket{
        width: 30px;
    }

    .vertical-line-navigation-basket{
        height: 5px;
        width: 100%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .left-horizontal-line-navigation-basket{
        height: calc(50% + 5px);
        width: 5px;
        top: 75%;
        left: 0;
        transform: translate(-50%, -50%);
    }

    .right-horizontal-line-navigation-basket{
        height: calc(50% + 5px);
        width: 5px;
        top: 25%;
        left: 0;
        transform: translate(-50%, -50%);
    }
}

@media (min-width: 992px) {

    .section-line-navigation-basket{
        height: 20px;
    }

    .vertical-line-navigation-basket{
        height: 100%;
        width: 5px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .left-horizontal-line-navigation-basket{
        height: 5px;
        width: calc(50% + 5px);
        top: 100%;
        left: 25%;
        transform: translate(-50%, -50%);
    }

    .right-horizontal-line-navigation-basket{
        height: 5px;
        width: calc(50% + 2.5px);
        top: 100%;
        left: 75%;
        transform: translate(-50%, -50%);
    }
}
</style>
