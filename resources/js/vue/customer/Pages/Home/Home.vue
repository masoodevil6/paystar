<template>
    <main class="container mt-3 px-3 p-0 form-shadow">

        <p class="border-bottom  font-weight-bold mb-2 pt-2">
            <strong class="h5">
                لیست اشتراک های
            </strong>
        </p>

        <list-subscribe/>

    </main>
</template>

<script>

import listSubscribe from "./components/ListSubscribes"

export default {
    components:{
        listSubscribe
    }
}
</script>
