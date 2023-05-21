import {subscribeApiFetch} from "../../Resource/SubscribeApiResource"
import {router} from "../../Routes/VueRoutes";

const state= {
    listSubscribes: [] ,
    subscribeInfo: {}
};

const getters= {
    getListSubscribes(state){
        return state.listSubscribes;
    },

    getSubscribeInfo(state){
        return state.subscribeInfo;
    },

};

const mutations= {
    setListSubscribes(state , listSubscribes){
        state.listSubscribes = listSubscribes;
    },

    setSubscribeInfo(state , subscribeInfo){
        state.subscribeInfo = subscribeInfo;
    },
};

const actions= {
    async subscribes(context){

        return await subscribeApiFetch.subscribes()
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
                    if (Array.isArray(result)){
                        context.commit("setListSubscribes" , result)
                    }
                    else {
                        console.log("error get subscribes")
                    }
                }
            ).catch(err=> console.log(err));
    },

    async subscribeInfo(context , slug){

        const cookieBasket = context.getters.getCookieBasketClient

        return await subscribeApiFetch.subscribeInfo(slug , cookieBasket)
            .then(
                response=>{
                    if( response.status != 200 ){
                        router.push({name:'home'});
                        throw response.status;
                    }else{
                        return response.json();
                    }
                }
            ).then(
                result=>{

                    if (result != null){
                        context.commit("setSubscribeInfo" , result)
                    }
                    else {
                        console.log("error get info subscribe")
                        router.push({name:'home'});
                    }
                }
            ).catch(err=> console.log(err));
    },
};

export default {state , getters , mutations , actions}
