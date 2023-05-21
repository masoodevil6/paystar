<template>
    <body class="container m-0 p-0">
        <section id="main-body-two-col" class="container-xxl body-container">

            <section class="row mx-0 mt-3">
                <aside id="sidebar" class="sidebar col-lg-3">
                    <CustomerPanelsList v-bind:panelNum="2"/>
                </aside>
                <section id="main-body" class="main-body col-lg-9">
                    <section class=" mr-1">

                        <p class="text-white bg-dark text-center py-1">
                            اطلاعات سفارش
                        </p>

                        <OrderResultInfoPayment/>
                        <OrderResultCodeOff/>
                        <TableBaskets v-bind:go-to-home="false" v-bind:with-option="false"/>

                    </section>
                </section>
            </section>

        </section>
    </body>
</template>

<script>
import CustomerPanelsList from '../../CustomerPanelsList';
import TableBaskets from "../../../Order/TableBaskets";
import OrderResultCodeOff from "../../../Order/Result/OrderResultCodeOff";
import OrderResultInfoPayment from "../../../Order/Result/OrderResultInfoPayment";


export default {
    components:{
        CustomerPanelsList ,
        TableBaskets ,
        OrderResultCodeOff ,
        OrderResultInfoPayment ,
    },
    methods:{
        async getInfoOrder(){
            await this.$store.dispatch("getInfoOrder");
        },
    },
    created() {
        this.getInfoOrder();
    }
}
</script>
