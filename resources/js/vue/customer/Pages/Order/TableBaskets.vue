<template>

    <section class=" mt-3 p-3 p-0 form-shadow">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                سـبد خـرید
            </strong>
        </p>

        <div v-if="listBasket != null  && listBasket.length > 0">
            <table class="table m-0 table-bordered rounded table-sm  table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="w-5  font-size-md text-center  p-1">ردیف</th>
                    <th scope="col" class="w-25  font-size-md text-center  p-1">عنوان</th>
                    <th scope="col" class="w-30  font-size-md text-center  p-1">توضیحات</th>
                    <th scope="col" class="font-size-md text-center  p-1">نهایی</th>

                    <th v-if="withOption === true" scope="col" class="w-5 text-center  font-size-md  p-1">
                        <span>حذف</span>
                    </th>

                </tr>
                </thead>


                <tbody>
                <template v-for="(infoItemBasket , itemKey) in listBasket" v-bind:key="infoItemBasket.itemId">
                    <ItemBasket v-bind:itemKey="itemKey+1" v-bind:item-basket="infoItemBasket" v-bind:with-option="withOption"/>
                </template>
                </tbody>


            </table>

        </div>
        <div v-else>
            <section class="row border border-danger shadow bg-white mt-2 mt-lg-0 mx-1 py-1 rounded">
                <section class="col-4">
                    <i id="icon-not-exist" class="fa fa-times-circle text-left text-danger d-block" aria-hidden="true"></i>
                </section>
                <section class="col-8">
                    <p  id="text-not-exist" class=" text-right text-danger m-0 font-weight-bold">
                        سبد خرید شما خالی است
                    </p>
                </section>
            </section>
        </div>

        <router-link v-if="goToHome" v-bind:to="{name: 'home'}" title="خانه" class="btn-nav m-1 text-hover-white  btn btn-warning shadow border border-dark rounded text-decoration-none  ">
            <i class="nav-icon fa fa-home   float-right border-left border-secondary"></i>
            <span class="pr-2 font-size-md font-weight-bold">
                بازگشت به صفحه خانه
            </span>

        </router-link>


    </section>

</template>

<script>
import ItemBasket from "./ItemBasket";
export default {
    props:{
        withOption: {
            type: Boolean ,
            default: true ,
        } ,
        goToHome: {
            type: Boolean ,
            default: true ,
        } ,
    },
    components:{
        ItemBasket
    },
    computed:{
        listBasket: function (){
            return this.$store.getters.getListBasket;
        },
    },
}

</script>

<style>
#icon-not-exist{
    font-size: 25pt;
}
#icon-not-exist , #text-not-exist{
    line-height: 40px;
}



.btn-basket {
    border-width: 2px !important;
    z-index: 10;
    width: 30px;
    height: 30px;
    transition: width 100ms, height 100ms, left 100ms, top 100ms, color 100ms;
}

.btn-basket i {
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.btn-basket:hover{
    width: 35px;
    height: 35px;
}

.btn-basket:hover .btn-basket i{
    font-size: 15pt;
    color: black;
}


</style>
