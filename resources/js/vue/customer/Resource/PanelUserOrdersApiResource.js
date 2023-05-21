import {APISettings} from "../config";


const defaultHeadersPost =  APISettings.headers;
const prefixPanelOrderApi ='user/orders/';

const panelUserOrderApi = {
    "getListOrder" : {
        "url" : APISettings.baseURL +  prefixPanelOrderApi + "get-list-order" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "getInfoOrder" : {
        "url" : APISettings.baseURL +  prefixPanelOrderApi + "get-info-order" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    }
};


export const panelUserOrderApiResource = {

    "getListOrder" : function (resNum , isFinish){

        const url = panelUserOrderApi.getListOrder.url ;
        const method = panelUserOrderApi.getListOrder.method;
        const headers = panelUserOrderApi.getListOrder.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        let body = new FormData();
        body.append('resNum', resNum);
        body.append('isFinish', isFinish);

        return  fetch(url , {method ,headers , body})
    },

    "getInfoOrder" : function (orderResNum){

        const url = panelUserOrderApi.getInfoOrder.url ;
        const method = panelUserOrderApi.getInfoOrder.method;
        const headers = panelUserOrderApi.getInfoOrder.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        let body = new FormData();
        body.append('orderResNum', orderResNum);

        return  fetch(url , {method ,headers , body})
    },

}
