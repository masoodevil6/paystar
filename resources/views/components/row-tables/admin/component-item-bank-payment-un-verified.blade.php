<tr>
    <td class="font-size-12">
        {{$bankPaymentUnVerifiedKey}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentUnVerifiedUserFullName}}
    </td>
    <td class="font-size-12">
        @if($bankPaymentUnVerifiedOrderBankPaymentId != null)
            <a href="{{route("admin.banks.payment.edit" , $bankPaymentUnVerifiedAuthority)}}"> تراکنش </a>
        @else
            -
        @endif
    </td>
    <td class="font-size-12">
        {{$bankPaymentUnVerifiedBankName}}
    </td>
    <td class="font-size-12">
        @if($bankPaymentUnVerifiedOrderId != null)
            <a href="{{route("admin.Orders.order.edit" , $bankPaymentUnVerifiedOrderId)}}"> {{$bankPaymentUnVerifiedOrderResNum}} </a>
        @else
            -
        @endif
    </td>
    <td class="font-size-12">
        {{$bankPaymentUnVerifiedStatus}}
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
            btn-type='delete'
            :url='route("admin.banks.un-verifies.destroy" , $bankPaymentUnVerifiedId)'/>

        <x-fields.component-button
            btn-type='edit'
            :url='route("admin.banks.un-verifies.show" , $bankPaymentUnVerifiedId)'/>

    </td>
</tr>
