import Vuex from 'vuex'
///-------------------
import navStore from './Modules/navStore';

import cookieLoginStore from "./Modules/cookieLoginStore";
import cookieBasket from "./Modules/cookieBasket";

import userStore from './Modules/userStore';
import subscribeStore from "./Modules/subscribeStore";
import basketStore from "./Modules/basketStore";
import paymentStore from "./Modules/paymentStore";

import PanelUserInfoStore from "./Modules/PanelUserInfoStore";
import PanelUserOrderStore from "./Modules/PanelUserOrderStore";
///PanelUserOrderStore
export const store= new Vuex.Store({
    modules:{
        navStore ,

        cookieBasket ,
        cookieLoginStore ,

        userStore ,
        subscribeStore ,

        basketStore ,
        paymentStore ,

        PanelUserInfoStore ,
        PanelUserOrderStore
    }
});

