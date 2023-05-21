<template>
    <main class="container container mt-3 px-3 p-0 form-shadow">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                {{subscribeInfo.title}}
            </strong>
        </p>

        <div class="row m-2 p-2">

            <div class="col-12 col-lg-4 m-0 p-0 mb-3 m-lg-0">
                <img src="/images/subscribes/image.png" v-bind:alt="subscribeInfo.title" height="200" class="m-auto d-block ">
            </div>

            <div class="col-12 col-lg-8 m-0 p-0">
                <div class="mx-1">

                    <p class=" text-right mb-1">
                        <small>
                            مدت:
                        </small>
                        <strong>
                            {{subscribeInfo.duration_text}}
                        </strong>
                    </p>

                    <p class="border rounded p-1 right rounded my-2" style="min-height: 100px">
                        {{subscribeInfo.description}}
                    </p>

                    <div class=" row  m-0 mb-1 ">
                        <div class="col-4 ">
                            <p class="bg-danger text-white text-center rounded  text_decoration_price mb-0">
                                {{subscribeInfo.real_price_text}}
                            </p>
                        </div>

                        <p class="col-8 bg-success text-white text-center rounded mb-0">
                            {{subscribeInfo.off_price_text}}
                        </p>
                    </div>


                    <div v-if="active == false">
                        <router-link v-bind:to="{name: 'order.basket'}" v-if="existInBasket" type="button" class="btn btn-dark text-white float-left mt-2 shadow px-3 border" style="min-width: 100px">
                            <i class="fa fa-basket-shopping"></i>
                            <strong>
                                مشاهده به سـبد خـرید
                            </strong>
                        </router-link>
                        <button v-else type="button"  v-on:click.prevent="addToBasket" class="btn btn-info float-left mt-2 shadow px-3" style="min-width: 100px">
                            <i class="fa fa-shopping-basket"></i>
                            <strong>
                                افـزودن به سـبد خـرید
                            </strong>
                        </button>
                    </div>
                    <div v-else>
                        <p class="bg-success text-white rounded mt-4 float-left px-3">
                            <i class="fa fa-check font-size-xlg mx-2"></i>
                            در حال حاضر، اشتراک فوق برای شما فعال می باشد
                        </p>
                    </div>


                </div>

            </div>

        </div>

    </main>
</template>

<script>

import {useRoute} from "vue-router/dist/vue-router";

export default {
    data(){
        return{
            slug: '' ,
            existInBasket: false ,
            active: false ,
        }
    } ,

    computed:{
        subscribeInfo: function (){
            const subscribeInfo = this.$store.getters.getSubscribeInfo;
            this.existInBasket = subscribeInfo.existInBasket;
            this.active = subscribeInfo.active;
            this.$store.commit("setExistInBasket" , this.existInBasket)
            return subscribeInfo;
        },

        existInBasket: function (){
            return this.$store.getters.getExistInBasket;
        },

    },

    methods:{
        async getSubscribeInfo (){
            await this.$store.dispatch("subscribeInfo" , this.slug)
        },

        async addToBasket (){
            this.existInBasket = false;
            this.active = false;
            this.$store.commit("setExistInBasket" , this.existInBasket)

            await this.$store.dispatch("addToBasket" , this.slug)
        },
    },

    created() {
        const route = useRoute()
        this.slug = route.params.slug

        this.getSubscribeInfo();
    }
}
</script>
