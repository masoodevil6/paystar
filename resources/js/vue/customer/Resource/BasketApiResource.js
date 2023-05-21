import {APISettings} from "../config";


const defaultHeadersPost =  APISettings.headers;
const prefixBasketApi ='order/basket/';

const basketApi = {
    "getListBasket" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "get-list-basket/" ,
        "method" : "GET" ,
        "headers" : defaultHeadersPost
    } ,
    "addToBasket" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "add-to-basket" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "deleteFromBasket" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "delete-from-basket" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
};


export const BasketApiResource = {

    "getListBasket" : function (cookieBasket){

        const url = basketApi.getListBasket.url +  cookieBasket;
        const method = basketApi.getListBasket.method;
        const headers = basketApi.getListBasket.headers;

        return fetch(url , {method ,headers})
    } ,

    "addToBasket" : function (slug , cookie){

        const url = basketApi.addToBasket.url;
        const method = basketApi.addToBasket.method;
        const headers = basketApi.addToBasket.headers;

        let body = new FormData();
        body.append('slug', slug);
        body.append('cookie', cookie);

        return fetch(url , {method ,headers ,body})
    } ,

    "deleteFromBasket" : function ( basketId , cookie){

        const url = basketApi.deleteFromBasket.url;
        const method = basketApi.deleteFromBasket.method;
        const headers = basketApi.deleteFromBasket.headers;

        let body = new FormData();
        body.append('basketId', basketId);
        body.append('cookie', cookie);

        return  fetch(url , {method ,headers ,body})
    }


}
