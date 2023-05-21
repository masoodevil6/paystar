<x-component-title-under-line
    title="سبد خرید"/>

<section class=" border border-dark shadow color-family-1 p-0 rounded mt-2">

    <section class="bg-white rounded p-0 m-2">

        <x-component_table_basket
            :list-basket="$listBasket"
            :show-option="false"
            :show-status-submitted="$showStatusSubmitted"/>

    </section>

</section>




<x-component-title-under-line
    title="کد تخفیف"/>

<x-component-info-code-off
    :code-off="$codeOff"
    :code-off-price="$codeOffPrice"
    :code-off-price-pass="$codeOffPricePass"/>






<x-component-title-under-line
    title=" جمع بندی"/>

<x-component-order-info-price
    :info-order-price="$infoPrice"/>






<x-component-title-under-line
    title="تراکنش موفق"/>

@if($existSuccessPayment)
    <x-component-info-payment
        :info-payment="$infoPayment"/>
@else
    <x-component-not-exist-item
        title="تراکنش موفقی"/>
@endif
