<template>
    <section class=" mt-2 mt-lg-0 pb-2">

        <section v-if="listOrders.length > 0" id="form_list_main_tickets" class="mx-5 mx-lg-2 my-3 row ">

            <section  v-for="$itemOrder in listOrders" class="col-12 p-0 ">
                <section  class="item-panel border border-dark m-2  shadow font-size-md position-relative">

                    <section class="d-lg-flex d-block border-bottom border gray-300 ">
                        <section class="col-12 col-lg-4 border-lg-left  border-white gray-100 font-weight-bold">
                            شماره رزرو سفارش
                        </section>
                        <section class="col-12 col-lg-8 ">
                            {{$itemOrder.res_num}}
                        </section>
                    </section>

                    <section class="d-lg-flex d-block border-bottom border blue-gray-300 text-white border-white">
                        <section class="col-12 col-lg-4 border-lg-left blue-gray-200 font-weight-bold">
                            مبلغ
                        </section>
                        <section class="col-12 col-lg-8 ">
                            {{$itemOrder.total_price_text_pass}}
                        </section>
                    </section>

                    <section class="d-lg-flex d-block border-bottom border gray-300 ">
                        <section class="col-12 col-lg-4 border-lg-left  border-white gray-100 font-weight-bold">
                            تاریخ ثبت
                        </section>
                        <section class="col-12 col-lg-8 ">
                            {{$itemOrder.created_at_persian}}
                        </section>
                    </section>

                    <section class="d-lg-flex d-block border-bottom border blue-gray-300 text-white border-white">
                        <section class="col-12 col-lg-4 border-lg-left blue-gray-200 font-weight-bold">
                            آخرین نتیجه
                        </section>
                        <section class="col-12 col-lg-8 ">
                            {{$itemOrder.description_finish}}
                        </section>
                    </section>



                    <router-link v-bind:to="{name:'customer.panel.order' , params:{resNum: $itemOrder.res_num}}"  title="مشاهده" class="btn-one btn-panel text-dark cursor-pointer position-absolute bg-warning border border-dark rounded shadow">
                        <i class="fa fa-eye position-absolute"></i>
                    </router-link>

                </section>
            </section>

        </section>

        <section v-else class="row border border-danger shadow bg-white mt-2 mt-lg-0 mx-1 py-1 rounded">
            <section class="col-4">
                <i id="icon-not-exist" class="fa fa-times-circle text-left text-danger d-block" aria-hidden="true"></i>
            </section>
            <section class="col-8">
                <p  id="text-not-exist" class=" text-right text-danger m-0 font-weight-bold">
                    سفارشی یافت نشد
                </p>
            </section>
        </section>

    </section>

</template>

<script>


export default {
    computed:{
        listOrders: function (){
            return this.$store.getters.getListOrders;
        },
    },
}
</script>

<style>
.btn-panel{
    border-width: 2px !important;
    z-index: 10;
    width: 30px;
    height: 30px;
    transition: width 100ms, height 100ms, left 100ms, top 100ms, color 100ms;
    transform: translate(50%, 50%)
}
.btn-panel i{
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
.btn-panel:hover{
    width: 35px;
    height: 35px;
}
.btn-panel:hover .btn-panel i{
    font-size: 15pt;
    color: black;
}

.btn-one{
    left: -10px;
    top: -10px;
}
.btn-one:hover {
    left: -15px;
    top: -15px;
}
</style>
