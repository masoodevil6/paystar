<template>

    <main class="container container mt-3 px-3 p-0 ">
        <orderNav v-bind:step="1"/>

        <section class="row my-2 mx-0 ">

            <section class="col-12 col-lg-9  p-0 mb-2 mb-lg-0">
                <section class="ml-2">
                    <TableBaskets v-bind:with-option="true" />
                </section>
            </section>

            <section class="col-12 col-lg-3 p-0">
                <InfoPrice/>

                <section v-if="infoPrice.isEmptyBasket ===false" class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

                    <section class="bg-white rounded p-0 m-2">

                        <router-link v-bind:to="{name: 'order.login'}" class="d-block border-white text-decoration-none  shadow text-center btn btn-info font-size-md  border border-dark  text-hover-white   px-2 font-weight-bold font-size-md " >
                            ثبت و پرداخت
                            <i class="fa fa-check mr-1 border border-white rounded p-1"></i>
                        </router-link>

                    </section>

                </section>




            </section>



        </section>

    </main>

</template>

<script>

import orderNav from "../orderNav";
import TableBaskets from "../TableBaskets";
import InfoPrice from "../InfoPrice";

export default {
    components: {
        orderNav ,
        TableBaskets ,
        InfoPrice ,
    },

    computed:{
        infoPrice: function (){
            return this.$store.getters.getInfoPrice;
        },
    },

    methods:{
        async getListBasket(){
            await this.$store.dispatch("getListBasket")
        },
    },
    created() {
        this.getListBasket();
    }
}

</script>
