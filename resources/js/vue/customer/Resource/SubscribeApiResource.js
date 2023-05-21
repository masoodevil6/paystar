import {APISettings} from "../config";

const defaultHeadersPost =  APISettings.headers;

const subscribeApi = {
    "subscribes" : {
        "url" : APISettings.baseURL + "subscribes" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "subscribeInfo" : {
        "url" : APISettings.baseURL  + "subscribe/" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    }
};

export const subscribeApiFetch = {

    "subscribes" : function (){

        const url = subscribeApi.subscribes.url;
        const method = subscribeApi.subscribes.method;
        const headers = subscribeApi.subscribes.headers;

        return fetch(url , {method ,headers })

    } ,

    "subscribeInfo" : function (subscribeSlug , cookieBasket){

        const url = subscribeApi.subscribeInfo.url+subscribeSlug;
        const method = subscribeApi.subscribeInfo.method;
        const headers = subscribeApi.subscribeInfo.headers;

        let body = new FormData();
        body.append('cookie', cookieBasket);

        return fetch(url , {method ,headers , body})
    }

}

