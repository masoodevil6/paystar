<tr>
    <td class="font-size-12">
        {{$codeOffPublicKey}}
    </td>
    <td class="font-size-12">
        {{$codeOffPublicCode}}
    </td>
    <td class="font-size-12">
        <img src="{{asset($codeOffPublicImage)}}" height="60">
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffPublicMinPrice)}}
    </td>
    <td class="font-size-12">
        {{persianPriceFormat($codeOffPublicOffPrice)}}
    </td>
    <td class="font-size-12">
        {{$codeOffPublicCreatedAt}}
    </td>
    <td class="font-size-12">
        {{$codeOffPublicPeriod}}
    </td>
    <td class="font-size-12">
        <x-fields.component-input-check-box
                title-fa='وضعیت'
                title-en='status'
                :url='route("admin.offs.code-off-public.status" , $codeOffPublicId)'
                :value='$codeOffPublicStatus'/>
    </td>
    <td class="text-left font-size-12 py-2">

        <x-fields.component-button
                btn-type='delete'
                :url='route("admin.offs.code-off-public.destroy" , $codeOffPublicId)'/>

        <x-fields.component-button
                btn-type='edit'
                :url='route("admin.offs.code-off-public.edit" , $codeOffPublicId)'/>

    </td>
</tr>