<template>
    <section class=" mt-3 p-3 p-0 form-shadow">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                نتیجه تراکنش
            </strong>
        </p>

        <section class="border border-dark p-0 rounded mt-2">

            <section class="bg-white rounded p-0 m-2">

                <section class="row border round m-0 p-0">


                    <section v-bind:class="(status) ? 'bg-success' : 'bg-danger'" class="col-12 px-0 py-2 m-0 row  border-bottom border   border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                نتیجه تراکنش
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center text-white ">
                            {{statusPayment}}
                        </section>
                    </section>


                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                پیام
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{fullMessage}}
                        </section>
                    </section>


                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                مبلغ
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{amount}}
                        </section>
                    </section>




                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                موضوع
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{description}}
                        </section>
                    </section>



                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                شماره رزرو
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{resNum}}
                        </section>
                    </section>



                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                شماره تراکنش
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{refNum}}
                        </section>
                    </section>



                    <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                        <section class="col-12 col-lg-4   ">
                            <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                                نام درگاه
                            </section>
                        </section>
                        <section class="col-12 col-lg-8  text-center ">
                            {{paymentName}}
                        </section>
                    </section>


                </section>

            </section>

        </section>
    </section>
</template>

<script>
import useStore from "vuex/dist/vuex.mjs";

export default {

    methods: {
        getInfoPayment: function() {
            return this.$store.getters.getInfoPayment;
        }
    },

    computed:{

        status:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('isStatusPayment')){
                return  value.isStatusPayment;
            }
            return false;
        },

        statusPayment:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('statusPayment')){
                return value.statusPayment;
            }
            return "-"
        },

        fullMessage:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('fullMessage')){
                return value.fullMessage;
            }
            return "-"
        },

        description:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('description')){
                return value.description;
            }
            return "-"
        },

        amount:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('amount')){
                return value.amount;
            }
            return "-"
        },

        resNum:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('resNum')){
                return value.resNum;
            }
            return "-"
        },

        refNum:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('refNum')){
                return value.refNum;
            }
            return "-"
        },

        paymentName:function (){
            const value = this.getInfoPayment();
            if (value.hasOwnProperty('paymentName')){
                return value.paymentName;
            }
            return "-"
        },

    }
};
</script>
