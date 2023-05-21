import {APISettings} from "../config";


const defaultHeadersPost =  APISettings.headers;
const prefixBasketApi ='order/payment/';

const paymentApi = {
    "getListBanks" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "get-list-banks" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "checkCodeOff" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "check-code-off" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "submitRequestPayment" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "submit-request-payment" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
    "result" : {
        "url" : APISettings.baseURL +  prefixBasketApi + "result" ,
        "method" : "POST" ,
        "headers" : defaultHeadersPost
    } ,
};


export const paymentApiResource = {

    "getListBanks" : function (){

        const url = paymentApi.getListBanks.url ;
        const method = paymentApi.getListBanks.method;
        const headers = paymentApi.getListBanks.headers;

        return  fetch(url , {method ,headers})
    },

    "checkCodeOff" : function (codeOff , cookie){

        const url = paymentApi.checkCodeOff.url ;
        const method = paymentApi.checkCodeOff.method;
        const headers = paymentApi.checkCodeOff.headers;

        let body = new FormData();
        body.append('codeOff', codeOff);
        body.append('cookie', cookie);

        return  fetch(url , {method ,headers ,body})
    },

    "submitRequestPayment" : function (serviceName , cookie , codeOff){

        const url = paymentApi.submitRequestPayment.url ;
        const method = paymentApi.submitRequestPayment.method;
        const headers = paymentApi.submitRequestPayment.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        let body = new FormData();
        body.append('className', serviceName);
        body.append('cookie', cookie);
        body.append('codeOff', codeOff);

        return  fetch(url , {method ,headers , body})
    },

    "result" : function (serviceName , dataPayment){

        const url = paymentApi.result.url ;
        const method = paymentApi.result.method;
        const headers = paymentApi.result.headers;
        headers.set('Authorization', 'Bearer '+APISettings.token);

        let body = new FormData();
        body.append('serviceName', serviceName);
        body.append('dataPayment',     JSON.stringify(dataPayment));

        return  fetch(url , {method ,headers , body})
    },

}
