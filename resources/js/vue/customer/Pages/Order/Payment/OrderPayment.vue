<template>

    <main class="container container mt-3 px-3 p-0 ">
        <orderNav v-bind:step="3"/>

        <section class="row my-2 mx-0 ">

            <section class="col-12 col-lg-9  p-0 mb-2 mb-lg-0">
                <section class="ml-2">
                    <OrderPaymentCodeOff ref="nameOfRef"/>
                    <OrderPaymentCardNum/>
                    <OrderPaymentListBanks/>
                </section>
            </section>

            <section class="col-12 col-lg-3 p-0">
                <InfoPrice/>

                <section v-if="infoPrice.isEmptyBasket ===false" class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

                    <section class="bg-white rounded p-0 m-2">

                        <button v-on:click="goToPayment"  class="d-block w-100 border-white text-decoration-none  shadow text-center btn btn-info font-size-md  border border-dark  text-hover-white   px-2 font-weight-bold font-size-md " >
                            پرداخت
                            <i class="fa fa-check mr-1 border border-white rounded p-1"></i>
                        </button>

                    </section>

                </section>
            </section>


        </section>

    </main>

</template>

<script>

import orderNav from "../orderNav";
import InfoPrice from "../InfoPrice";
import OrderPaymentCodeOff from "./OrderPaymentCodeOff";
import OrderPaymentListBanks from "./OrderPaymentListBanks";
import OrderPaymentCardNum from "./OrderPaymentCardNum";
import {router} from "../../../Routes/VueRoutes";

export default {
    components: {
        orderNav ,
        InfoPrice ,
        OrderPaymentCodeOff ,
        OrderPaymentCardNum ,
        OrderPaymentListBanks ,
    },

    computed:{
        infoPrice: function (){
            return this.$store.getters.getInfoPrice;
        },
    },

    methods:{
        async getListBasket(){
            await this.$store.dispatch("getListBasket")

            if (this.infoPrice.isEmptyBasket){
                router.push({name: "order.basket"})
            }
            if (!this.$store.getters.getIsLogin){
                router.push({name: "order.login"})
            }
        },



        async goToPayment(){
            this.$store.commit("setCodeOff" , this.$refs.nameOfRef.codeOff);
            await this.$store.dispatch("submitRequestPayment")
        },

    },
    created() {
        this.getListBasket();
    }
}

</script>
