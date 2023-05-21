<template>
    <section class=" container mt-3 px-3 p-0 form-shadow pb-2">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                شماره کارت پرداخت
            </strong>
        </p>


        <section class="row m-0 p-0">

            <section class="col-12 col-lg-7 row p-0 m-0">

                <div class="col-12 col-lg-9">
                    <input  name="search" type="text" placeholder="شماره کارت پرداخت" v-model="userCartNum"  class="my-1 form-control form-control-sm form-text font-size-12">
                </div>

                <section class="col-12 col-lg-3">
                    <button type="button" v-on:click="setUserInfo" class="w-80 btn btn-primary btn-sm my-1 d-block" >
                        ثبت
                    </button>
                </section>

            </section>

        </section>
    </section>
</template>

<script>

export default {

    computed:{
        userCartNum: {
            get() {
                return this.$store.getters.getUserCartNum;
            },
            set(value) {
                // Note: we are using destructuring assignment syntax here.
                this.$store.commit("setUserCartNum" , value);
            }
        } ,
    },
    methods:{
        async getUserInfo(){
            await this.$store.dispatch("getInfoClient");
        },

        async setUserInfo(){
            await this.$store.dispatch("setInfoClient");
        }
    },

    created() {
        this.getUserInfo();
    }

}
</script>
