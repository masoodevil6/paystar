<tr>
    <td class="font-size-12">
        {{$bankPaymentRefundKey}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefundUserFullName}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefundResNum}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefundRefNum}}
    </td>
    <td class="font-size-12">
        @if($bankPaymentRefundOrderBankPaymentId != null)
            <a href="{{route("admin.banks.payment.edit" , $bankPaymentRefundAuthority)}}"> تراکنش </a>
        @else
            -
        @endif
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefundBankName}}
    </td>
    <td class="font-size-12">
        @if($bankPaymentRefundOrderId != null)
            <a href="{{route("admin.Orders.order.edit" , $bankPaymentRefundOrderId)}}"> {{$bankPaymentRefundOrderResNum}} </a>
        @else
            -
        @endif
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefundStatus}}
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
            btn-type='delete'
            :url='route("admin.banks.refund.destroy" , $bankPaymentRefundId)'/>

        <x-fields.component-button
            btn-type='edit'
            :url='route("admin.banks.refund.show" , $bankPaymentRefundId)'/>

    </td>
</tr>
