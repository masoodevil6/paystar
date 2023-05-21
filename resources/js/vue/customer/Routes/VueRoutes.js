import * as VueRouter from 'vue-router'
///-------------------
import {Home} from "./VueRouteRequires";

import {SubscribeInfo} from "./VueRouteRequires";

import {OrderBasket} from "./VueRouteRequires";
import {OrderLogin} from "./VueRouteRequires";
import {OrderPayment} from "./VueRouteRequires";
import {OrderResult} from "./VueRouteRequires";

import {Login} from "./VueRouteRequires";

import {PanelUserInfo} from "./VueRouteRequires";
import {PanelUserOrders} from "./VueRouteRequires";
import {PanelUserOrderInfo} from "./VueRouteRequires";

///-------------------
const routes= [
    {
        path: '/',
        children: [
            {
                path: '',
                component: Home ,
                name:'home'
            },

            {
                path: 'subscribe/:slug',
                component: SubscribeInfo ,
                name:'subscribe.info'
            },

            {
                path: 'order',
                children:[
                    {
                        path: 'basket',
                        component: OrderBasket ,
                        name:'order.basket'
                    },
                    {
                        path: 'login',
                        component: OrderLogin ,
                        name:'order.login'
                    },
                    {
                        path: 'checkout',
                        component: OrderPayment ,
                        name:'order.payment'
                    },
                    {
                        path: 'result/:serviceName',
                        component: OrderResult ,
                        name:'order.result'
                    },
                ]
            },


            {
                path: 'login',
                component: Login ,
                name:'login'
            },

            {
                path: 'panel',
                children: [
                    {
                        path: 'info',
                        component: PanelUserInfo ,
                        name:'customer.panel.user' ,
                    },
                    {
                        path: 'orders',
                        children : [
                            {
                                path: 'list',
                                component: PanelUserOrders ,
                                name:'customer.panel.orders' ,
                            } ,
                            {
                                path: 'info/:resNum',
                                component: PanelUserOrderInfo ,
                                name:'customer.panel.order' ,
                            }
                        ]
                    }
                ]
            },
        ]
    },

];
///-------------------
export const router = VueRouter.createRouter({
    routes,

    history: VueRouter.createWebHistory(),
    scrollBehavior(){
        return {
            x:0 ,
            y:0
        }
    }
});

