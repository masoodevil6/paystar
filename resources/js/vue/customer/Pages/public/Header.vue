<template>
    <header class="header mb-2" style="background-color: #2d3436">

        <section class="container-xxl ">

            <router-link v-bind:to="{name: 'home'}" class="btn btn-warning text-dark round p-1 mx-2 my-2">
                <i class="fa fa-home mx-1"></i>
                <span class="d-none d-md-inline">
                    خانه
                </span>
            </router-link>


            <router-link v-if="isLogin"  v-bind:to="{name: 'customer.panel.user'}" class="btn btn-warning text-dark round p-1 mx-2 my-2">
                <i class="fa fa-user mx-1"></i>
                <span class="d-none d-md-inline">
                    پنل کاربری
                </span>
            </router-link>
            <router-link v-else v-bind:to="{name: 'login'}" class="btn btn-warning text-dark round p-1 mx-2 my-2">
                <i class="fa fa-user-lock mx-1"></i>
                <span class="d-none d-md-inline">
                    ورود/ثبت نام
                </span>
            </router-link>


            <router-link v-bind:to="{name: 'order.basket'}" class="btn btn-warning text-dark round p-1 mx-2 my-2">
                <i class="fa fa-basket-shopping-simple mx-1"></i>
                <span class="d-none d-md-inline">
                    سبد خرید
                </span>
            </router-link>


        </section>

    </header>
</template>

<script>

export default {
    data(){
        return{

        }
    } ,
    computed:{
        isLogin: function (){
            return this.$store.getters.getIsLogin;
        },
    }
}

</script>
