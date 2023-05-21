<?php

use App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup\CreatePanelGroupAdmin;
use App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup\CreatePanelPanelsInPanelGroupAdmin;
use App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup\CreatePanelUserAdminInPanelGroupAdmin;
use App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup\CreatePanelBankInPanelGroupBank;
use App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup\CreatePanelBankPaymentInPanelGroupBank;
use App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup\CreatePanelBankPaymentRefundInPanelGroupBank;
use App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup\CreatePanelBankPaymentUnVerifiesInPanelGroupBank;
use App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup\CreatePanelGroupBank;
use App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup\CreatePanelGroupOff;
use App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup\CreatePanelOffPersonInPanelGroupOff;
use App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup\CreatePanelOffPublicInPanelGroupOff;
use App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup\CreatePanelOffStatusInPanelGroupOff;
use App\Http\Services\onTimeService\Admins\PanelGroups\OrderGroup\CreatePanelGroupOrder;
use App\Http\Services\onTimeService\Admins\PanelGroups\OrderGroup\CreatePanelOrderInPanelGroupOrder;
use App\Http\Services\onTimeService\Admins\PanelGroups\PublicGroup\CreatePanelGroupPublic;
use App\Http\Services\onTimeService\Admins\PanelGroups\PublicGroup\CreatePanelSettingSitePanelGroupPublic;
use App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup\CreatePanelGroupSubscribe;
use App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup\CreatePanelSubscribePanelGroupSubscribe;
use App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup\CreatePanelSubscribePaymentsPanelGroupSubscribe;
use App\Http\Services\onTimeService\Admins\PanelGroups\UserGroup\CreatePanelGroupUser;
use App\Http\Services\onTimeService\Admins\PanelGroups\UserGroup\CreatePanelUserPanelGroupUser;

return[

    "groups"=>[
        [
            "group_class" => CreatePanelGroupAdmin::class ,
            "group_name" => CreatePanelGroupAdmin::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupBank::class ,
            "group_name" => CreatePanelGroupBank::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupOrder::class ,
            "group_name" => CreatePanelGroupOrder::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupPublic::class ,
            "group_name" => CreatePanelGroupPublic::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupSubscribe::class ,
            "group_name" => CreatePanelGroupSubscribe::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupUser::class ,
            "group_name" => CreatePanelGroupUser::$panelGroupName ,
        ],

        [
            "group_class" => CreatePanelGroupOff::class ,
            "group_name" => CreatePanelGroupOff::$panelGroupName ,
        ],
    ],




    "panels"=>[

        ////=======================================================
        /// admin
        ////=======================================================
        [
            "group_name" => CreatePanelGroupAdmin::$panelGroupName ,
            "panel_class" => CreatePanelPanelsInPanelGroupAdmin::class ,
            "panel_name" => CreatePanelPanelsInPanelGroupAdmin::$panelName
        ],
        [
            "group_name" => CreatePanelGroupAdmin::$panelGroupName ,
            "panel_class" => CreatePanelUserAdminInPanelGroupAdmin::class ,
            "panel_name" => CreatePanelUserAdminInPanelGroupAdmin::$panelName
        ],


        ////=======================================================
        /// bank
        ////=======================================================

        [
            "group_name" => CreatePanelGroupBank::$panelGroupName ,
            "panel_class" => CreatePanelBankInPanelGroupBank::class ,
            "panel_name" => CreatePanelBankInPanelGroupBank::$panelName
        ],

        [
            "group_name" => CreatePanelGroupBank::$panelGroupName ,
            "panel_class" => CreatePanelBankPaymentInPanelGroupBank::class ,
            "panel_name" => CreatePanelBankPaymentInPanelGroupBank::$panelName
        ],

        [
            "group_name" => CreatePanelGroupBank::$panelGroupName ,
            "panel_class" => CreatePanelBankPaymentUnVerifiesInPanelGroupBank::class ,
            "panel_name" => CreatePanelBankPaymentUnVerifiesInPanelGroupBank::$panelName
        ],

        [
            "group_name" => CreatePanelGroupBank::$panelGroupName ,
            "panel_class" => CreatePanelBankPaymentRefundInPanelGroupBank::class ,
            "panel_name" => CreatePanelBankPaymentRefundInPanelGroupBank::$panelName
        ],



        ////=======================================================
        /// order
        ////=======================================================

        [
            "group_name" => CreatePanelGroupOrder::$panelGroupName ,
            "panel_class" => CreatePanelOrderInPanelGroupOrder::class ,
            "panel_name" => CreatePanelOrderInPanelGroupOrder::$panelName
        ],






        ////=======================================================
        /// public
        ////=======================================================
        [
            "group_name" => CreatePanelGroupPublic::$panelGroupName ,
            "panel_class" =>  CreatePanelSettingSitePanelGroupPublic::class ,
            "panel_name" => CreatePanelSettingSitePanelGroupPublic::$panelName
        ],



        ////=======================================================
        /// subscribe
        ////=======================================================
        [
            "group_name" => CreatePanelGroupSubscribe::$panelGroupName ,
            "panel_class" =>  CreatePanelSubscribePanelGroupSubscribe::class ,
            "panel_name" => CreatePanelSubscribePanelGroupSubscribe::$panelName
        ],
        [
            "group_name" => CreatePanelGroupSubscribe::$panelGroupName ,
            "panel_class" =>  CreatePanelSubscribePaymentsPanelGroupSubscribe::class ,
            "panel_name" => CreatePanelSubscribePaymentsPanelGroupSubscribe::$panelName
        ],



        ////=======================================================
        /// user
        ////=======================================================

        [
            "group_name" => CreatePanelGroupUser::$panelGroupName ,
            "panel_class" =>  CreatePanelUserPanelGroupUser::class ,
            "panel_name" => CreatePanelUserPanelGroupUser::$panelName
        ],

        ////=======================================================
        /// off
        ////=======================================================
        [
            "group_name" => CreatePanelGroupOff::$panelGroupName ,
            "panel_class" =>  CreatePanelOffStatusInPanelGroupOff::class ,
            "panel_name" => CreatePanelOffStatusInPanelGroupOff::$panelName
        ],
        [
            "group_name" => CreatePanelGroupOff::$panelGroupName ,
            "panel_class" =>  CreatePanelOffPublicInPanelGroupOff::class ,
            "panel_name" => CreatePanelOffPublicInPanelGroupOff::$panelName
        ],
        [
            "group_name" => CreatePanelGroupOff::$panelGroupName ,
            "panel_class" => CreatePanelOffPersonInPanelGroupOff::class ,
            "panel_name" => CreatePanelOffPersonInPanelGroupOff::$panelName
        ],

    ],

];
