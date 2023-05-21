import {APISettings} from "../../config";
import { useCookies } from "vue3-cookies";

const { cookies } = useCookies();

const state= {
    cookieNameLogin : 'PayStar_Auth_Token'
};

const getters= {

    GetCookieNameLoginClient(state){
        return state.cookieNameLogin;
    },

    GetCookieLoginClient(state){
        const cookielogin = cookies.get(state.cookieNameLogin);
        APISettings.token = cookielogin;
        return cookielogin;
    },
};

const mutations= {
    SetAuthCookie(state , loginResult){
        cookies.set(
            state.cookieNameLogin,
            loginResult.token ,
            loginResult.expire
        );
        APISettings.token = loginResult.token;
    } ,

    deleteAuthCookie(state){
        cookies.remove(state.cookieNameLogin);
        APISettings.token = "";
    }
};

const actions= {

};

export default {state , getters , mutations , actions}
