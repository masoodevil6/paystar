import {BasketApiResource} from "../../Resource/BasketApiResource"

const state= {
    listBasket: [] ,
    infoPrice: {} ,
    existInBasket : false
};

const getters= {
    getListBasket(state){
        return state.listBasket;
    },
    getInfoPrice(state){
        return state.infoPrice;
    },

    getExistInBasket(state){
        return state.existInBasket;
    },

};

const mutations= {
    setListBasket(state , listBasket){
        state.listBasket = listBasket;
    },

    setInfoPrice(state , infoPrice){
        state.infoPrice = infoPrice;
    },

    setExistInBasket(state , existInBasket){
        state.existInBasket = existInBasket;
    },
};

const actions= {
    async getListBasket(context){

        const cookieBasket = context.getters.getCookieBasketClient

        return await BasketApiResource.getListBasket(cookieBasket)
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
                    if (result != null && result.hasOwnProperty('listBasket')&& result.hasOwnProperty('infoPrice')){
                        context.commit("setExistInBasket" , true);
                        context.commit("setListBasket" , result.listBasket);
                        context.commit("setInfoPrice" , result.infoPrice);
                    }
                    else {
                        console.log("error get list basket")
                    }
                }
            ).catch(err=> console.log(err));
    },



    async addToBasket(context , slug){

        const cookieBasket = context.getters.getCookieBasketClient

        return await BasketApiResource.addToBasket(slug , cookieBasket)
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
                    if (result > 0){
                        context.commit("setExistInBasket" , true)
                    }
                    else {
                        console.log("error add to basket subscribe")
                    }
                }
            ).catch(err=> console.log(err));
    },



    async deleteFromBasket(context , basketId){

        const cookieBasket = context.getters.getCookieBasketClient

        return await BasketApiResource.deleteFromBasket(basketId , cookieBasket)
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
                    console.log(result);
                    if (result != null && result.hasOwnProperty('listBasket')&& result.hasOwnProperty('infoPrice')){
                        context.commit("setExistInBasket" , false);
                        context.commit("setListBasket" , result.listBasket);
                        context.commit("setInfoPrice" , result.infoPrice);
                    }
                    else {
                        console.log("error get subscribes")
                    }
                }
            ).catch(err=> console.log(err));
    },

};

export default {state , getters , mutations , actions}
