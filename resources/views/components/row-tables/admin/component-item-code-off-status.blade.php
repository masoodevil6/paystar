<tr>
    <td class="font-size-12">
        {{$codeOffStatusKey}}
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffStatusMinPrice)}}
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffStatusOffPrice)}}
    </td>
    <td class="font-size-12">
        {{$codeOffStatusPeriod}}
    </td>
    <td class="font-size-12">
        <x-fields.component-input-check-box
                title-fa='وضعیت'
                title-en='status'
                :url='route("admin.offs.code-off-status.status" , $codeOffStatusId)'
                :value='$codeOffStatusStatus'/>
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
                btn-type='delete'
                :url='route("admin.offs.code-off-status.destroy" , $codeOffStatusId)'/>

        <x-fields.component-button
                btn-type='edit'
                :url='route("admin.offs.code-off-status.edit" , $codeOffStatusId)'/>

    </td>
</tr>