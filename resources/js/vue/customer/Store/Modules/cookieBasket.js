import { useCookies } from "vue3-cookies";

const { cookies } = useCookies();

const state= {
    cookieBasket : 'PayStar_Basket'
};

const getters= {

    getCookieBasketClient(state){
        const cookieBasket = cookies.get(state.cookieBasket);
        if (cookieBasket != null && cookieBasket != ""){
            return cookieBasket;
        }
        else {
            const newCookie = Date.now();
            cookies.set(
                state.cookieBasket ,
                Date.now() ,
                "7d"
            );
            return newCookie;
        }
    },
};

const mutations= {

};

const actions= {

};

export default {state , getters , mutations , actions}
