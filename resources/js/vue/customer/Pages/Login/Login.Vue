<template>
    <div v-if="token == null || token == ''">
        <Register/>
    </div>
    <div v-else>
        <Confirm/>
    </div>
</template>

<script>
import Register from "./Register";
import Confirm from "./Confirm";
import {router} from "../../Routes/VueRoutes";

export default {
    props:{
        routeNameSuccess: {
            type: String ,
            default: 'home' ,
        }
    },
    components:{
        Register ,
        Confirm
    },
    computed:{
        token: function (){
            console.log(this.routeNameSuccess)

            const token = this.$store.getters.getToken;
            console.log(this.$store.getters.getIsLogin)
            if (this.$store.getters.getIsLogin === true){
                router.push({name: this.routeNameSuccess})
            }
            return token;
        },
    }
}
</script>

