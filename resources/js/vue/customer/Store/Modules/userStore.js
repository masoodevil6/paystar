import {loginApiFetch} from "../../Resource/LoginApiResouce"
import {router} from "../../Routes/VueRoutes";

const state= {
    token : '' ,
    inputLogin: '',
    isLogin : true
};

const getters= {
    getToken(state){
        return state.token;
    },

    getInputLogin(state){
        return state.inputLogin;
    },

    getIsLogin(state){
        return state.isLogin;
    },
};

const mutations= {
    setToken(state , token){
        state.token = token;
    },

    setInputLogin(state , inputLogin){
        state.inputLogin = inputLogin;
    },

    setIsLogin(state , isLogin){
        state.isLogin = isLogin;
    },
};

const actions= {
    async checkLastLogin(context){

        context.getters.GetCookieLoginClient;

        return await loginApiFetch.checkLastLogin()
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
                    if (result.status){
                        context.commit("setIsLogin" , true)
                    }
                    else{
                        context.commit("setIsLogin" , false)
                        context.commit("setInputLogin" , "")
                    }
                }
            ).catch(err=> console.log(err));
    },

    async RegisterUser(context , inputLogin){

        return  await loginApiFetch.register(inputLogin)
            .then(
                response=>{
                    if( response.status != 200 ){
                        throw response.status;
                    }else{
                        return response.json();
                    }
                }
            ).then(
                result => {
                    if (result.isValid){
                        context.commit("setToken" , result.token );
                        context.commit("setInputLogin" , inputLogin);
                    }
                    else {
                        return alert(result.msg)
                    }
            })
            .catch(err=> console.log(err));

    },

    async confirmLogin(context , otpCode){
        const token = context.getters.getToken;
        return await loginApiFetch.confirmLogin(token , otpCode)
            .then(
                response=>{
                    if( response.status != 200 ){
                        throw response.status;
                    }else{
                        return response.json();
                    }
                }
            ).then(
                result => {
                    if (result.status){
                        context.commit("SetAuthCookie" , {token , expire: result.exp + 'd'});
                        context.commit("setIsLogin" , true)
                        context.commit("setToken" , null );
                    }
                    else{
                        alert(result.msg)
                    }
                }
            ).catch(err=> console.log(err));
    },

};

export default {state , getters , mutations , actions}
