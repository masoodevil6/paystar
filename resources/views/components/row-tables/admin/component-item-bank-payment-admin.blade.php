<tr>
    <td class="font-size-12">
        {{$bankPaymentKey}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentUserFullName}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentResNum}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentRefNum}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentBankName}}
    </td>
    <td class="font-size-12">
        @if($bankPaymentOrderId != null)
            <a href="{{route("admin.Orders.order.edit" , $bankPaymentOrderId)}}"> {{$bankPaymentOrderResNum}} </a>
        @else
            ت.تستی
        @endif
    </td>
    <td class="font-size-12">
        {{$bankPaymentIsTest}}
    </td>
    <td class="font-size-12">
        {{$bankPaymentIsStatus}}
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
            btn-type='delete'
            :url='route("admin.banks.payment.destroy" , $bankPaymentAuthority)'/>

        <x-fields.component-button
            btn-type='edit'
            :url='route("admin.banks.payment.edit" , $bankPaymentAuthority)'/>

    </td>
</tr>
