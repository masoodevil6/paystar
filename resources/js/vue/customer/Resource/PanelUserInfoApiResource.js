import {APISettings} from "../config";


const defaultHeadersPost =  APISettings.headers;
const prefixPanelClientAli ='user/person/';

const panelUserInfoApi = {
    "info" : {
        "url" : APISettings.baseURL +  prefixPanelClientAli + "info" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "set" : {
        "url" : APISettings.baseURL +  prefixPanelClientAli + "set" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    }
};


export const panelUserInfoApiResource = {

    "info" : function (){

        const url = panelUserInfoApi.info.url ;
        const method = panelUserInfoApi.info.method;
        const headers = panelUserInfoApi.info.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        return  fetch(url , {method ,headers})
    },

    "set" : function (userName , userFamily , userCartNum){

        const url = panelUserInfoApi.set.url ;
        const method = panelUserInfoApi.set.method;
        const headers = panelUserInfoApi.set.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        let body = new FormData();
        body.append('userName', userName);
        body.append('userFamily', userFamily);
        body.append('userCartNum', userCartNum);

        return  fetch(url , {method ,headers , body})
    },

}
