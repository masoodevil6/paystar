
import {panelUserOrderApiResource} from "../../Resource/PanelUserOrdersApiResource";
import {useRoute} from "vue-router/dist/vue-router";

const state= {
    isFinish: -1 ,
    orderResNum : "" ,

    listOrders:[]
};

const getters= {
    getIsFinish(state){
        return state.isFinish;
    },
    getOrderResNum(state){
        return state.orderResNum;
    },

    getListOrders(state){
        return state.listOrders;
    },
};

const mutations= {
    setIsFinish(state , isFinish){
        state.isFinish = isFinish;
    },
    setOrderResNum(state , orderResNum){
        state.orderResNum = orderResNum;
    },

    setListOrders(state , listOrders){
        state.listOrders = listOrders;
    },
};

const actions= {
    getListOrder: function (context){
        panelUserOrderApiResource.getListOrder(context.getters.getOrderResNum , context.getters.getIsFinish)
            .then(
                response=>{
                    if( response.status != 200 ){
                        throw response.status;
                    }else{
                        return response.json();
                    }
                }
            ).then(
            result=>{
                console.log(result)
                if (result != null && Array.isArray(result)){
                    context.commit("setListOrders" , result);
                }
                else {
                    console.log("error list orders client")
                }
            }
        ).catch(err=> console.log(err));
    },
    getInfoOrder: function (context){
        const route = useRoute();
        const resNum = route.params.resNum

        panelUserOrderApiResource.getInfoOrder(resNum)
            .then(
                response=>{
                    if( response.status != 200 ){
                        throw response.status;
                    }else{
                        return response.json();
                    }
                }
            ).then(
            result=>{
                console.log(result)
                if (result != null){

                    if (result.hasOwnProperty('codeOff')){
                        context.commit("setCodeOff" , result.codeOff);
                    }

                    if (result.hasOwnProperty('codeOffPriceTextPass')){
                        context.commit("setCodeOffPrice" , result.codeOffPriceTextPass);
                    }

                    if (result.hasOwnProperty('infoPrice')){
                        context.commit("setInfoPrice" , result.infoPrice);
                    }

                    if (result.hasOwnProperty('listBasket')){
                        context.commit("setListBasket" , result.listBasket);
                    }

                    if (result.hasOwnProperty('infoPayment')){
                        context.commit("setInfoPayment" , result.infoPayment);
                    }
                }
                else {
                    console.log("error get info order")
                }
            }
        ).catch(err=> console.log(err));
    }
};

export default {state , getters , mutations , actions}
