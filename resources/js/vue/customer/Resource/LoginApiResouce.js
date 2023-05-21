import {APISettings} from "../config";


const defaultHeadersPost =  APISettings.headers;
const prefixLoginAli ='login/';

const loginApi = {
    "checkLastLogin" : {
        "url" : APISettings.baseURL +  prefixLoginAli + "check-last-login" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "register" : {
        "url" : APISettings.baseURL +  prefixLoginAli + "register" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "confirmLogin" : {
        "url" : APISettings.baseURL +  prefixLoginAli + "confirm-login" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
};


export const loginApiFetch = {

    "checkLastLogin" : function (){

        const token = APISettings.token;
        if (token != null || token != ""){
            const url = loginApi.checkLastLogin.url;
            const method = loginApi.checkLastLogin.method;
            const headers = loginApi.checkLastLogin.headers;
            headers.set('Authorization', 'Bearer '+APISettings.token);

            return fetch(url , {method ,headers})
        }

    } ,

    "register" : function (inputLogin){

        const url = loginApi.register.url;
        const method = loginApi.register.method;
        const headers = loginApi.register.headers;

        let body = new FormData();
        body.append('inputLogin', inputLogin);

        return fetch(url , {method ,headers ,body})

    } ,

    "confirmLogin" : function ( token , otpCode){

        const url = loginApi.confirmLogin.url;
        const method = loginApi.confirmLogin.method;
        const headers = loginApi.confirmLogin.headers;
        headers.set('Authorization', 'Bearer '+token);

        let body = new FormData();
        body.append('otp_code', otpCode);

        return  fetch(url , {method ,headers ,body})
    }


}
