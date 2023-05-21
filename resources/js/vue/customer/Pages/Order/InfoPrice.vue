<template>
    <section class=" border border-dark shadow color-family-1 p-0 rounded ">

        <section class="bg-white rounded p-0 m-2">

            <section class=" d-block border-bottom border gray-300 p-2 border-white">
                <section class=" gray-100 font-weight-bold rounded text-center">
                    مبلغ سفارش
                </section>
                <section class="text-center ">
                    {{infoPrice.realPriceTextPass}}
                </section>
            </section>


            <section class=" d-block border-bottom border gray-300 p-2 border-white">
                <section class="gray-100 font-weight-bold rounded text-center">
                    تخفیف
                </section>
                <section class="text-center">
                    {{infoPrice.offPriceTextPass}}
                </section>
            </section>

            <section class=" d-block border-bottom border blue-gray-300 text-white border-white p-2">
                <section class="blue-gray-200 font-weight-bold rounded text-center">
                    مبلغ قابل پرداخت
                </section>
                <section class="text-center ">
                    {{infoPrice.totalPriceTextPass}}
                </section>
            </section>

        </section>

    </section>

</template>

<script>
export default {
    computed:{
        infoPrice: function (){
            return this.$store.getters.getInfoPrice;
        },
    },
}
</script>



