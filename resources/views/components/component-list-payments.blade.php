@if(sizeof($payments)>0)
    @foreach($payments As $itemPayment)
        <x-component-info-payment
            :info-payment="$itemPayment"/>
    @endforeach
@else
    <x-component-not-exist-item
        title="تراکنشی"/>
@endif
