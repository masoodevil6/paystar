<tr>
    <td class="font-size-12">
        {{$codeOffPersonKey}}
    </td>
    <td class="font-size-12">
        {{$codeOffPersonCode}}
    </td>
    <td class="font-size-12">
        {{$codeOffPersonUser}}
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffPersonMinPrice)}}
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffPersonOffPrice)}}
    </td>
    <td class="font-size-12">
        {{$codeOffPersonCreatedAt}}
    </td>
    <td class="font-size-12">
        {{$codeOffPersonPeriod}}
    </td>
    <td class="font-size-12">
        <x-fields.component-input-check-box
                title-fa='وضعیت'
                title-en='status'
                :url='route("admin.offs.code-off-person.status" , $codeOffPersonId)'
                :value='$codeOffPersonStatus'/>
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
                btn-type='delete'
                :url='route("admin.offs.code-off-person.destroy" , $codeOffPersonId)'/>

    </td>
</tr>