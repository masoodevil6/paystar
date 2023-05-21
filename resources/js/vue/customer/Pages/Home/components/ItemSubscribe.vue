<template>
    <div class=" border rounded form-shadow">
        <router-link v-bind:to="{name: 'subscribe.info' , params:{slug:  subscribeInfo.slug}}" class="row m-2 p-2 text-decoration-none">
            <div class="col-12 col-lg-4 m-0 p-0 mb-3 m-lg-0">
                <img src="/images/subscribes/image.png" v-bind:alt="subscribeInfo.title" height="125" class="m-auto d-block ">
            </div>

            <div class="col-12 col-lg-8 m-0 p-0">
                <div class="mx-1">
                    <p class="bg-dark text-white  rounded text-center mb-1">
                        <strong>
                            {{subscribeInfo.title}}
                        </strong>

                    </p>

                    <div class=" row rounded m-0 mb-1 ">
                        <p class="col-6 bg-danger text-white text-center rounded  text_decoration_price mb-0">
                            <small>
                                {{subscribeInfo.real_price_text}}
                            </small>
                        </p>
                        <p class="col-6 bg-success text-white text-center rounded mb-0">
                            <small>
                                {{subscribeInfo.off_price_text}}
                            </small>
                        </p>
                    </div>

                    <p class="bg-dark text-white  rounded text-center mb-1">
                        <small>
                            مدت:
                        </small>
                        <strong>
                            {{subscribeInfo.duration_text}}
                        </strong>
                    </p>


                    <button type="button" class="btn btn-info float-left mt-2 ">
                         مشاهده
                    </button>
                </div>

            </div>
        </router-link>

    </div>

</template>

<script>
export default {
    props:["subscribeInfo"]
}
</script>
