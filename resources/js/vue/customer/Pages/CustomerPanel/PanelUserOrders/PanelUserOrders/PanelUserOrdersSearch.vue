<template>
    <form class="row m-2 pb-2 border-bottom ">

        <div class="col-3 col-lg-2 mx-1 ">
            <select v-model="isFinish" name="is_finish" id="filter-for-status" class="form-control form-control-sm form-text">
                <option value="-1"  v-bind:selected="isFinish==-1" > همه </option>
                <option value="0"  v-bind:selected="isFinish==0"> ناتمام </option>
                <option value="1"  v-bind:selected="isFinish==1"> پایان یافته </option>
            </select>
        </div>

        <input name="search"  type="text" v-model="orderResNum" placeholder="جستجو شماره رزرو سفارش..." class="col-8 col-lg-6 form-control form-control-sm form-text">

        <button type="button" v-on:click="getListOrder" class="btn btn-info round float-left font-size-md  mx-1">
            <i class="fa fa-search"></i>
        </button>
    </form>
</template>


<script>

export default {
    computed:{

        isFinish: {
            get() {
                return this.$store.getters.getIsFinish;
            },
            set(value) {
                this.$store.commit("setIsFinish" , value);
            }
        } ,

        orderResNum: {
            get() {
                return this.$store.getters.getOrderResNum;
            },
            set(value) {
                this.$store.commit("setOrderResNum" , value);
            }
        } ,

    },
    methods:{
        async getListOrder(){
            await this.$store.dispatch("getListOrder");
        },
    },
    created() {
      this.getListOrder();
    }
}

</script>
