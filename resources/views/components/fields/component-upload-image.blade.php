<section class="@if($full) col-12 @else col-6  @endif mt-2">

    <label for="label-for-{{$titleEn}}" class="d-block text-right font-size-12">
        {{$titleFa}}
    </label>

    <input type="file" id="label-for-{{$titleEn}}" name="{{$titleEn}}" class="form-control form-control-sm mb-1">

    {{$slot}}


    <x-input-errors field="{{$titleEn}}"/>

</section>