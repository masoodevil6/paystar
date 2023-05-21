<table class="table m-0 table-bordered rounded table-sm ">
    <thead>
    <tr>
        <th scope="col" class="w-5  font-size-md text-center  p-1">ردیف</th>
        <th scope="col" class="w-25  font-size-md text-center  p-1">عنوان</th>
        <th scope="col" class="w-30  font-size-md text-center  p-1">توضیحات</th>
        <th scope="col" class="font-size-md text-center  p-1">نهایی</th>
        @if($showOption)
            <th scope="col" class="w-5 text-center  font-size-md  p-1">
                <span>حذف</span>
            </th>
        @endif
        @if($showStatusSubmitted)
            <th scope="col" class="w-5 text-center  font-size-md  p-1">
                <span>وضعیت اعمال</span>
            </th>
        @endif
    </tr>
    </thead>

    <tbody>
    @foreach($listBasket As $key => $itemBasket)

        <x-component_item_basket
                :item-key='$key + 1'
                :item-info="$itemBasket"
                :show-option="$showOption"
                :show-status-submitted="$showStatusSubmitted"/>
    @endforeach
    </tbody>


</table>
