<template>

    <tr>
        <td class="p-0 text-center font-size-md">
            {{ itemKey}}
        </td>

        <td class="p-0 text-center font-size-md">
            {{itemBasket.itemName}}
        </td>

        <td class="row m-0 p-0 text-center font-size-md border-0 py-1">
            <template v-for="itemDescription in itemBasket.itemDescription">
                <section class="col-12 col-lg-5 p-0 ">
                    <span class="d-block text-center font-weight-bold">
                        {{itemDescription.title}}
                        :
                    </span>

                </section>
                <section class="col-12 col-lg-7  p-0">
                         <span class="d-block font-weight-bold">
                            {{itemDescription.value}}
                         </span>
                </section>
            </template>
        </td>

        <td class=" p-0 text-center font-size-md">

            <section v-if="itemBasket.itemOffPrice> 0" class=" text-center bg-dark text-white text_decoration_price line-height-20">
                {{itemBasket.itemOffPriceText}}
            </section>
            <section class="text-center">
                <span class="line-height-20 font-weight-bold">
                    {{itemBasket.itemTotalPriceTextPass}}
                </span>
            </section>

        </td>

        <td v-if="withOption" class="p-0 text-center font-size-md position-relative">
            <button type="button"  title="حذف از سبد خرید"  v-on:click.prevent="deleteFromBasket(itemBasket.itemId)" class="btn-basket btn-panel cursor-pointer position-center position-absolute bg-danger border border-dark rounded shadow">
                <i class="fa fa-trash position-absolute text-white"></i>
            </button>
        </td>

    </tr>

</template>

<script>
export default {
   props: [ "itemKey" , "itemBasket" , "withOption"] ,

    methods:{
        async deleteFromBasket(basketId){
            await this.$store.dispatch("deleteFromBasket" , basketId)
        },
    },
}
</script>








