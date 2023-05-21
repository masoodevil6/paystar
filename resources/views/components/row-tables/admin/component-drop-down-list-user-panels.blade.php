<x-fields.component-drop-down-list-options
        title-fa='پنل ها'
        title-en='userPanel'>

    <x-fields.component-item-drop-down-list-options
            :url='route("admin.users.user.show" , $userId)'
            title="مشاهده"
            icon="fa fa-eye"/>


    <x-fields.component-item-drop-down-list-options
            :url='route("admin.subscribes.subscribe-payment.index" , ["user" => $userName])'
            title="تراکنش اشتراک ها"
            icon="fa fa-usd"/>


</x-fields.component-drop-down-list-options>
