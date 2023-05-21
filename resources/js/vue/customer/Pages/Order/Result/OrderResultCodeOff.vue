<template>

    <section class=" mt-3 p-3 p-0 form-shadow">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                کد تخفیف
            </strong>
        </p>

        <section v-if="!(codeOff === '' || codeOff == null)" class="bg-white rounded p-0 m-2">

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        بن تخفیف
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{codeOff}}
                </section>
            </section>

            <section class="col-12 px-0 py-2 m-0 row  border-bottom border gray-300  border-white">
                <section class="col-12 col-lg-4   ">
                    <section class="d-block gray-100 rounded font-weight-bold text-center mx-2">
                        مبلغ بن تخفیف
                    </section>
                </section>
                <section class="col-12 col-lg-8  text-center ">
                    {{CodeOffPrice}}
                </section>
            </section>

        </section>

        <section v-else class="py-2">
            <section class="row border border-danger  bg-white mt-2 mt-lg-0 mx-1 py-1 rounded">
                <section class="col-4">
                    <i id="icon-not-exist" class="fa fa-times-circle text-left text-danger d-block" aria-hidden="true"></i>
                </section>
                <section class="col-8">
                    <p  id="text-not-exist" class=" text-right text-danger m-0 font-weight-bold">
                        کد تخفیفی اعمال نشده است
                    </p>
                </section>
            </section>

        </section>
    </section>

</template>

<script>

export default {
    computed:{
        codeOff: function (){
            return  this.$store.getters.getCodeOff;
        },
        CodeOffPrice: function (){
            return this.$store.getters.getCodeOffPrice;
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
</style>
