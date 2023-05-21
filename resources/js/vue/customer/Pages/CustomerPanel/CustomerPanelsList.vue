<template>

    <section v-if="isLogin" class="border border-dark form-shadow shadow color-family-1 rounded">

        <router-link v-bind:to="{name:'customer.panel.user'}" v-bind:class="(panelNum===1) ? 'bg-info' : 'bg-warning'" class=" text-decoration-none item-customer-panel d-block border border-dark rounded m-2 cursor-pointer btn-warning  text-hover-white">
            <i v-bind:class="(panelNum===1) ? 'text-white' : 'text-dark'" class="icon-item-customer-panel float-right  px-2 border-left border-white  fa fa-user-circle-o text-white" aria-hidden="true"></i>
            <span v-bind:class="(panelNum===1) ? 'text-white' : 'text-dark'" class="title-item-customer-panel pr-2 font-size-md font-weight-bold text-white">
                حساب کاربر
            </span>
        </router-link>

        <router-link v-bind:to="{name:'customer.panel.orders'}" v-bind:class="(panelNum===2) ? 'bg-info' : 'bg-warning'" class=" text-decoration-none item-customer-panel d-block border border-dark rounded m-2 cursor-pointer btn-warning  text-hover-white">
            <i v-bind:class="(panelNum===2) ? 'text-white' : 'text-dark'" class="icon-item-customer-panel float-right  px-2 border-left border-white  fa fa-shopping-bag text-white" aria-hidden="true"></i>
            <span v-bind:class="(panelNum===2) ? 'text-white' : 'text-dark'" class="title-item-customer-panel pr-2 font-size-md font-weight-bold text-white">
                سفارشات
            </span>
        </router-link>

        <a v-on:click="logoutFormPanel()"  class=" text-decoration-none item-customer-panel d-block border border-dark rounded m-2 cursor-pointer btn-warning  text-hover-white bg-danger">
            <i  class="icon-item-customer-panel float-right  px-2 border-left border-white  fa fa-shopping-bag text-white" aria-hidden="true"></i>
            <span  class="title-item-customer-panel pr-2 font-size-md font-weight-bold text-white">
                خروج
            </span>
        </a>

    </section>

</template>


<script>
import {router} from "../../Routes/VueRoutes";

export default {
    props: ["panelNum"] ,
    computed:{
        isLogin:function(){
            const value = this.$store.getters.getIsLogin;
            if (!value){
                router.push({name: "home"})
            }
            return value;
        }
    },
    methods:{
        logoutFormPanel:function (){
            this.$store.commit("deleteAuthCookie");
            location.reload();
        }
    }
}
</script>


<style>
.item-customer-panel{
    height: 37px;
}

.icon-item-customer-panel{
    height: 35px;
    width: 35px;
    line-height: 35px;
    border-width: 2px !important;
}
.title-item-customer-panel{
    display: flow-root;
    line-height: 35px;
}


</style>
