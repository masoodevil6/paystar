<template>
    <section class=" container mt-3 px-3 p-0 form-shadow pb-2">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                بررسی کد تخفیف
            </strong>
        </p>


        <section class="row m-0 p-0">

            <section class="bg-white rounded p-0 m-2">

                <div v-for='bank in listBanks' class="d-inline-block m-2">
                    <div v-on:click="selectBank(bank.service_name)"  v-bind:class="(bankSelected== bank.service_name) ? 'border-primary' : 'border-dark'" style="border-width: 2px!important;" class="item-payment p-2 rounded border cursor-pointer shadow">
                        <img height="40" v-bind:src="bank.image" v-bind:alt="bank.image_alt" v-bind:title="bank.image_title">
                    </div>
                </div>

            </section>



        </section>
    </section>
</template>

<script>
export default {

    computed:{
        listBanks: function (){
            return this.$store.getters.getListBanks;
        },
        bankSelected: function (){
            return this.$store.getters.getBankSelected;
        },
    },

    methods:{
        async getListBanks (){
            await this.$store.dispatch("getListBanks")
        },
        selectBank (className){
            this.$store.commit("setBankSelected" , className)
        },
    },
    created() {
        this.getListBanks();
    }
}
</script>
