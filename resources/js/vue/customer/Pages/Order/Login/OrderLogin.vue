<template>

    <main class="container container mt-3 px-3 p-0 ">
        <orderNav v-bind:step="2"/>

        <section class="row my-2 mx-0 ">

            <section class="col-12 col-lg-9  p-0 mb-2 mb-lg-0">
                <section class="ml-2">

                    <Login v-bind:route-name-success="'order.payment'"/>

                </section>
            </section>

            <section class="col-12 col-lg-3 p-0">
                <InfoPrice/>
            </section>

        </section>

    </main>

</template>

<script>

import orderNav from "../orderNav";
import InfoPrice from "../InfoPrice";
import Login from "../../Login/Login";

export default {
    components: {
        orderNav ,
        Login ,
        InfoPrice ,
    },

    computed:{
        infoPrice: function (){
            console.log(this.$store.getters.getInfoPrice)
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
