<template>
    <main class="container m-0 p-0">
        <section id="main-body-two-col" class="container-xxl body-container">

            <section class="row mx-0 mt-3">
                <aside id="sidebar" class="sidebar col-lg-3">
                    <CustomerPanelsList v-bind:panelNum="1"/>
                </aside>
                <section id="main-body" class="main-body col-lg-9">
                    <section class="form-shadow mr-1">

                        <p class="text-white bg-dark text-center py-1">
                            اطلاعات کاربر
                        </p>

                        <form class=" p-2">

                            <div class="form-group row">
                                <label for="userName" class="col-sm-2 col-form-label">نام</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="userName" v-model="userName">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="userFamily" class="col-sm-2 col-form-label">نام خانوادگی</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="userFamily" v-model="userFamily">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="userCartNum" class="col-sm-2 col-form-label">شماره کارت</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="userCartNum" v-model="userCartNum">
                                </div>
                            </div>

                            <button type="button" v-on:click="setUserInfo" class="btn btn-primary direction-ltr">ثبت</button>

                        </form>

                    </section>
                </section>
            </section>

        </section>
    </main>
</template>

<script>
import CustomerPanelsList from '../CustomerPanelsList';
import { mapGetters } from 'vuex';
export default {
    components:{
        CustomerPanelsList
    },

    computed:{

        userName: {
            // getter
            get() {
                return this.$store.getters.getUserName;
            },
            // setter
            set(value) {
                // Note: we are using destructuring assignment syntax here.
                this.$store.commit("setUserName" , value);
            }
        } ,


        userFamily: {
            // getter
            get() {
                return this.$store.getters.getUserFamily;
            },
            // setter
            set(value) {
                this.$store.commit("setUserFamily" , value);
            }
        } ,


        userCartNum: {
            // getter
            get() {
                return this.$store.getters.getUserCartNum;
            },
            // setter
            set(value) {
                // Note: we are using destructuring assignment syntax here.
                this.$store.commit("setUserCartNum" , value);
            }
        } ,

    },

    methods:{

        async getUserInfo(){
            await this.$store.dispatch("getInfoClient");
        },

        async setUserInfo(){
            await this.$store.dispatch("setInfoClient");
        }
    },
    created() {
        this.getUserInfo();
    }
}
</script>
