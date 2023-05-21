<template>
    <body class="container m-0 p-0">
        <section id="main-body-two-col" class="container-xxl body-container">

            <section class="row mx-0 mt-3">
                <aside id="sidebar" class="sidebar col-lg-3">
                    <CustomerPanelsList v-bind:panelNum="2"/>
                </aside>
                <section id="main-body" class="main-body col-lg-9">
                    <section class="form-shadow mr-1">

                        <p class="text-white bg-dark text-center py-1">
                            سفارشات
                        </p>

                        <PanelUserOrdersSearch/>

                        <PanelUserOrdersList/>

                    </section>
                </section>
            </section>

        </section>
    </body>
</template>

<script>
import CustomerPanelsList from '../../CustomerPanelsList';
import PanelUserOrdersSearch from './PanelUserOrdersSearch';
import PanelUserOrdersList from './PanelUserOrdersList';

export default {
    components:{
        CustomerPanelsList ,
        PanelUserOrdersSearch ,
        PanelUserOrdersList ,
    }
}
</script>
