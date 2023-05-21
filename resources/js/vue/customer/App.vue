<template>
    <app-header/>

    <nav/>

    <transition enter-active-class="animated fadeIn">
        <router-view></router-view>
    </transition>

    <app-footer/>
</template>

<script>
import AppHeader from "./Pages/public/Header";
import AppFooter from "./Pages/public/Footer";

export default {

    components: {
        appHeader: AppHeader,
        appFooter: AppFooter ,
    }
    ,
    methods:{
        async CheckForLogin(){
            await this.$store.dispatch("checkLastLogin")
        },
    },
    created() {
        this.CheckForLogin();
    }

};
</script>
