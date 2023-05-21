
import {panelUserInfoApiResource} from "../../Resource/PanelUserInfoApiResource";

const state= {
    userName: '',
    userFamily: '',
    userCartNum: '',
};

const getters= {
    getUserName(state){
        return state.userName;
    },
    getUserFamily(state){
        return state.userFamily;
    },
    getUserCartNum(state){
        return state.userCartNum;
    },
};

const mutations= {
    setUserName(state , userName){
        state.userName = userName;
    },
    setUserFamily(state , userFamily){
        state.userFamily = userFamily;
    },
    setUserCartNum(state , userCartNum){
        state.userCartNum = userCartNum;
    },
};

const actions= {
    getInfoClient(context){

        panelUserInfoApiResource.info()
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
                if (result != null && result.hasOwnProperty('name')&& result.hasOwnProperty('family')&& result.hasOwnProperty('cart_number')){
                    context.commit("setUserName" , result.name);
                    context.commit("setUserFamily" , result.family);
                    context.commit("setUserCartNum" , result.cart_number);
                }
                else {
                    console.log("error get info client")
                }
            }
        ).catch(err=> console.log(err));

    },

    setInfoClient(context){

        panelUserInfoApiResource.set(context.getters.getUserName , context.getters.getUserFamily , context.getters.getUserCartNum)
            .then(
                response=>{
                    console.log(response)

                    if( response.status != 200 ){
                        throw response.status;
                    }else{
                        return response.text();
                    }
                }
            ).then(
            result=>{
                if (result != null && result !== ""){
                    alert(result)
                }
                else {
                    console.log("error get info client")
                }
            }
        ).catch(err=> console.log(err));

    },
};

export default {state , getters , mutations , actions}
