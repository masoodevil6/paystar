import {paymentApiResource} from "../../Resource/paymentApiResource"
import {APISettings} from "../../config";
import {router} from "../../Routes/VueRoutes";

import {useRoute} from "vue-router/dist/vue-router";



const state= {
    codeOff:'' ,
    codeOffPrice : '' ,

    messageCheckCodeOff: '' ,
    statusCheckCodeOff : false,
    //------------

    listBanks:[],
    bankSelected: '' ,

    // ---------------

    infoPayment:{}
};

const getters= {
    getCodeOff(state){
        return state.codeOff;
    },
    getCodeOffPrice(state){
        return state.codeOffPrice;
    },

    getMessageCheckCodeOff(state){
        return state.messageCheckCodeOff;
    },
    getStatusCheckCodeOff(state){
        return state.statusCheckCodeOff;
    },

    // ---------------
    getListBanks(state){
        return state.listBanks;
    },

    getBankSelected(state){
        return state.bankSelected;
    },

    // ---------------

    getInfoPayment(state){
        return state.infoPayment;
    },
};

const mutations= {
    setCodeOff(state , codeOff){
        state.codeOff = codeOff;
    },
    setCodeOffPrice(state , codeOffPrice){
        state.codeOffPrice = codeOffPrice;
    },


    setMessageCheckCodeOff(state , messageCheckCodeOff){
        state.messageCheckCodeOff = messageCheckCodeOff;
    },
    setStatusCheckCodeOff(state , statusCheckCodeOff){
        state.statusCheckCodeOff = statusCheckCodeOff;
    },
    // ---------------

    setListBanks(state , listBanks){
        state.listBanks = listBanks;
    },

    setBankSelected(state , bankSelected){
        state.bankSelected = bankSelected;
    },

    // ---------------

    setInfoPayment(state , infoPayment){
        state.infoPayment = infoPayment;
    },

};

const actions= {
    getListBanks(context){

        paymentApiResource.getListBanks()
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
                if (result != null && result.length > 0){
                    context.commit("setListBanks" , result);
                    context.commit("setBankSelected" , result[0].service_name);
                }
                else {
                    console.log("error get list basket")
                }
            }
        ).catch(err=> console.log(err));

    },

    checkCodeOff(context , codeOff){
        context.commit("setCodeOff" , codeOff);
        context.commit("setMessageCheckCodeOff" , '');
        context.commit("setStatusCheckCodeOff" , '');

        paymentApiResource.checkCodeOff(codeOff , context.getters.getCookieBasketClient)
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
                if (result != null && result.hasOwnProperty('title') && result.hasOwnProperty('status')){
                    context.commit("setStatusCheckCodeOff" , result.status);
                    context.commit("setMessageCheckCodeOff" , result.title);
                }
                else {
                    console.log("error get list basket")
                }
            }
        ).catch(err=> console.log(err));

    },

    submitRequestPayment(context){
        paymentApiResource.submitRequestPayment(context.getters.getBankSelected ,   context.getters.getCookieBasketClient , context.getters.getCodeOff )
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
                if (result != null &&
                    result.hasOwnProperty('title')&&
                    result.hasOwnProperty('status')&&
                    result.hasOwnProperty('url') &&
                    result.hasOwnProperty('gotoPanel')){

                    if (result.gotoPanel){
                        alert("لطفا شماره کارت خود را در پنل وارد نمایید ...")
                        router.push({name:"customer.panel.user"});
                    }
                    else {
                        if (result.status){
                            window.location.href = result.url;
                        }
                        else {
                            alert(result.title)
                        }
                    }
                }
                else {
                    console.log("error get list basket")
                }
            }
        ).catch(err=> console.log(err));
    },

    resultPayment(context){
        const route = useRoute();

        let serviceName = route.params.serviceName
        const data = route.query;

        paymentApiResource.result(serviceName  , data)
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

                    if (result.hasOwnProperty('codeOffPricePass')){
                        context.commit("setCodeOffPrice" , result.codeOffPricePass);
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
                    console.log("error get result payment")
                }
            }
        ).catch(err=> console.log(err));
    }
};

export default {state , getters , mutations , actions}
