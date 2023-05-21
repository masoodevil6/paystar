<section class="@if($full) col-12 @else col-6  @endif  mt-2">

    <label for="select-option-{{$titleEn}}" class="d-block text-right font-size-12">
        {{$titleFa}}
    </label>

    <select @if($method) onchange="changeValue{{$titleEn}}(this)" @endif  id="select-option-{{$titleEn}}" @if($disabled == 1) disabled="disabled" @endif  name="{{$titleEn}}" class=" form-control form-control-sm form-text font-size-12" aria-label="Default select example">
        {{$slot}}
    </select>

    <x-input-errors field="{{$titleEn}}"/>

</section>