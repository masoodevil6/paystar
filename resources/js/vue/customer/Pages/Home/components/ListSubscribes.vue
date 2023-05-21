<template>

    <div class="row">
        <div v-for="itemSubscribe in listSubscribes" v-bind:key="itemSubscribe.id" class="col-12 col-md-6 col-lg-4 ">
            <itemSubscribe v-bind:subscribeInfo="itemSubscribe"/>
        </div>

    </div>

</template>

<script>
import itemSubscribe from "./ItemSubscribe";
export default {
    components:{
        itemSubscribe
    },

    computed:{
        listSubscribes: function (){
            return this.$store.getters.getListSubscribes;
        },
    },

    methods:{
        async getListSubscribe (){
            await this.$store.dispatch("subscribes")
        },
    },

    created() {
        this.getListSubscribe();
    }
}
</script>
