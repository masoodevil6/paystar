<template>
    <section class=" container mt-3 px-3 p-0 form-shadow pb-2">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                بررسی کد تخفیف
            </strong>
        </p>


        <section class="row m-0 p-0">

            <section class="col-12 col-lg-7 row p-0 m-0">

                <div class="col-12 col-lg-9">
                    <input  name="search" type="text" placeholder="کد تخفیف" v-model="codeOff"  class="my-1 form-control form-control-sm form-text font-size-12">
                </div>

                <section class="col-12 col-lg-3">
                    <button type="button" v-on:click="checkCodeOff" class="w-80 btn btn-primary btn-sm my-1 d-block" >
                        جستجو
                    </button>
                </section>

            </section>

            <section class="col-12 col-lg-5">
                <span v-if="showMessage" class="rounded shadow text-white px-2 py-1 line-height-30 mx-2 my-1 float-left"
                      v-bind:class="bgMessage" >
                    {{messageCheckCodeOff}}
                </span>
            </section>

        </section>
    </section>
</template>

<script>

export default {


    data(){
        return{
            codeOff: ""
        }
    },
    computed:{
        messageCheckCodeOff: function (){
            return this.$store.getters.getMessageCheckCodeOff;
        },
        statusCheckCodeOff: function (){
            return this.$store.getters.getStatusCheckCodeOff;
        },
        showMessage: function (){
            return !(this.messageCheckCodeOff === "" || this.messageCheckCodeOff == null);
        },
        bgMessage: function (){
            return this.statusCheckCodeOff === true ? 'bg-success' : 'bg-danger';
        },
    },
    methods:{
        async checkCodeOff (){
            await this.$store.dispatch("checkCodeOff" , this.codeOff)
        }
    },

}
</script>
