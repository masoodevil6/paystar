<tr>
    <td class="font-size-12">
        {{$orderKey}}
    </td>
    <td class="font-size-12">
        {{$orderResNum}}
    </td>
    <td class="font-size-12">
        {{$orderUserName}}
    </td>
    <td class="font-size-12">
        {{$orderIsFinish}}
    </td>
    <td class="font-size-12">
        {{$orderDescriptionFinish}}
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
            btn-type='delete'
            :url='route("admin.Orders.order.destroy" , $orderId)'/>

        <x-fields.component-button
            btn-type='edit'
            :url='route("admin.Orders.order.edit" , $orderId)'/>

    </td>
</tr>
