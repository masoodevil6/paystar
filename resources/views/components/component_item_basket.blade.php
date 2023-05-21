
<tr>
    <td class="p-0 text-center font-size-md">
        {{$itemKey}}
    </td>
    <td class="p-0 text-center font-size-md">
        {{$itemInfo->getItemName()}}
    </td>
    <td class="p-0 text-center font-size-md">
        @foreach($itemInfo->getItemDescription() As $itemDescription)
            @if($itemDescription instanceof  \App\Http\Services\Basket\ModelDescriptionItemBasket)
                <section class="row p-0">
                    <section class="col-12 col-lg-5 p-0">
                        <span class="d-block text-center font-weight-bold">
                            {{$itemDescription -> getDescriptionTitle()}}
                            :
                        </span>
                    </section>
                    <section class="col-12 col-lg-7  p-0">
                         <span class="d-block font-weight-bold">
                             {{$itemDescription -> getDescriptionValue()}}
                         </span>
                    </section>
                </section>
            @elseif( is_array($itemDescription) && isset($itemDescription["title"]) && isset($itemDescription["value"]))


                <section class="row p-0">
                    <section class="col-12 col-lg-5 p-0">
                        <span class="d-block text-center font-weight-bold">
                            {{$itemDescription["title"]}}
                            :
                        </span>
                    </section>
                    <section class="col-12 col-lg-7  p-0">
                         <span class="d-block font-weight-bold">
                             {{$itemDescription["value"]}}
                         </span>
                    </section>
                </section>


            @elseif(is_string($itemDescription))
                <p class="row p-0">
                    {{$itemDescription}}
                </p>
            @endif
        @endforeach
    </td>

    <td class=" p-0 text-center font-size-md">

        @if($itemInfo->getItemOffPrice() > 0)
            <section class=" text-center bg-dark text-white text_decoration_price line-height-20">
                {{$itemInfo->getItemPriceText()}}
            </section>
        @endif

        <section class="text-center">
            <span class="line-height-20 font-weight-bold">
                {{$itemInfo->getItemTotalPriceTextPass()}}
            </span>
        </section>

    </td>

    @if($showOption)
        <td class="p-0 text-center font-size-md">
            <form  method="post" action="{{route("order.basket.delete-from-basket" , $itemInfo->getItemId())}}" class="height-40px  position-relative  " >
                @csrf
                @method("delete")
                <button onclick="goToConfirmDeleteBasket(this)"
                        title="حذف از سبد خرید"
                        type="button"
                        class="btn-basket btn-panel cursor-pointer position-center position-absolute bg-danger border border-dark rounded shadow">
                    <i class="fa fa-trash position-absolute text-white"></i>
                </button>
            </form>
        </td>
    @endif

    @if($showStatusSubmitted)
        <td class="p-0 text-center font-size-md">
            @if($itemInfo->isSubmitted())
                اعمال شده
            @else
                اعمال نشده
            @endif
        </td>
    @endif

</tr>

@if($showOption)
    <script>

        function goToConfirmDeleteBasket(element) {
            swalConfirmDelete(submitForm , element)
        }

        function submitForm(element) {
            $(element).parent().submit();
        }

        function swalConfirmDelete(callback , element) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'حذف از سبد خرید',
                text: "آیا از حذف ایتم از سبد خرید خود مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
                reverseButtons: true
            }).then(function (result) {
                if (result.value == true){
                    callback(element);
                }
                else if(result.dismiss === swal.DismissReason.cancel){
                    swalWithBootstrapButtons.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد",
                        icon: 'error',
                        confirmButtonText: 'باشه'
                    });
                }
            });

        }

    </script>
@endif
