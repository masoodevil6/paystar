<template>

    <main class="container container mt-3 px-3 p-0 ">
        <orderNav v-bind:step="4"/>

        <section class="row my-2 mx-0 ">

            <section class="col-12 col-lg-9  p-0 mb-2 mb-lg-0">
                <section class="ml-2">
                    <OrderResultInfoPayment/>
                    <OrderResultCodeOff/>
                    <TableBaskets v-bind:go-to-home="false" v-bind:with-option="false"/>
                </section>
            </section>

            <section class="col-12 col-lg-3 p-0">
                <InfoPrice/>

                <section v-if="resNum !==''"  class=" border border-dark shadow color-family-1 p-0 rounded mt-2  text-decoration-none  ">

                    <section class="bg-white rounded p-0 m-2">

                        <router-link v-bind:to="{name:'customer.panel.order' , params:{resNum}}"  class="d-block border-white text-decoration-none  shadow text-center btn btn-info font-size-md  border border-dark  text-hover-white   px-2 font-weight-bold font-size-md " >
                            نمایش سفارش
                            <i class="fa fa-info mr-1 border border-white rounded p-1"></i>
                        </router-link>

                    </section>

                </section>

            </section>


        </section>

    </main>

</template>

<script>

import orderNav from "../orderNav";
import InfoPrice from "../InfoPrice";
import TableBaskets from "../TableBaskets";
import OrderResultCodeOff from "./OrderResultCodeOff";
import OrderResultInfoPayment from "./OrderResultInfoPayment";


import {useRoute, useRouter} from "vue-router/dist/vue-router";

export default {
    components: {
        orderNav ,
        InfoPrice ,
        TableBaskets ,
        OrderResultCodeOff ,
        OrderResultInfoPayment ,
    },

    computed:{

        resNum:function (){
            const value = this.$store.getters.getInfoPayment;
            if (value.hasOwnProperty('resNum')){
                return value.resNum;
            }
            return ""
        }
    },

    methods:{
        async checkResultPayment(){
            await this.$store.dispatch("resultPayment")
        },
    },

    created() {
        this.checkResultPayment();
    }
}

</script>
