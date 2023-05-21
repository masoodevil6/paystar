<meta name="csrf-token" content="{{ csrf_token() }}" />
<section id="search-user" class="border round my-2 p-2 col-12">
    <section class="row border round m-0 p-0">

        <section class="col-8 row p-0 m-0">
            <label for="label-for-search" class="col-4 bg-grey text-white font-size-md text-center m-0 line-height-40">
                جتجو کاربران
            </label>

            <div class="col-8">
                <input  id="label-for-search" name="search" type="text" placeholder="جستجوی ایمیل کاربران" v-model="search"  class="m-2 form-control form-control-sm form-text font-size-12">
            </div>

        </section>

        <section class="col-4">
            <button type="button" v-on:click="submitSearchUserEmail" class="w-80 btn btn-primary btn-sm my-2 mx-auto  d-block" >
                جستجو
            </button>
        </section>

    </section>


    <section class=" border round m-0 p-0">

        <section class="row p-0 m-1" v-for="user in users">

            <section class="col-2 bg-warning rounded-right border-left border-white">
                <input v-bind:id="'label-for-user-'+user.id" v-bind:value="user.email"  name="users[]" type="checkbox" class="mx-auto my-2 d-block">
            </section>
            <section class="col-10 bg-info text-white rounded-left">
                <label  v-bind:for="'label-for-user-'+user.id" v-text="user.email + ' - ' + user.full_name" class="text-center font-size-md d-block m-0 line-height-30 bg-info"></label>
            </section>

        </section>

        <button type="button" v-if="!isFinish" v-on:click="searchNextPageUserEmail" class="w-80 btn btn-primary btn-sm my-2 mx-auto  d-block" >
            جستجو موارد بیشتر
        </button>

    </section>

</section>

<script src="{{asset("plugins/loading_ajax/loading_ajax.js")}}"></script>
<script src="{{asset("public/js/vue.js")}}" ></script>
<script>

    var app =
        new Vue({
        el:"#search-user",
        data: {
            csrf: '{{ csrf_token() }}' ,
            route: '{{ route("admin.offs.code-off-person.search-users") }}' ,
            page: 1 ,
            searchFroPage : '{{$search}}' ,
            search: '{{$search}}' ,
            isFinish: {{($users->hasMorePages()) ? 'true' : 'false'}},
            users:  @json($users->items())
        } ,
        methods:{
            submitSearchUserEmail : function () {
                this.page = 1;
                this.users = [];
                this.searchFroPage = this.search;
                this.searchUserEmail();
            } ,
            searchNextPageUserEmail : function () {
                if (!this.isFinish){
                    this.page ++;
                    this.search = this.searchFroPage;
                    this.searchUserEmail();
                }
            } ,

            searchUserEmail: function () {

                var dataJson= {
                    "search": this.search ,
                    "_token": this.csrf
                };
                var loading =  $("body").loadingAjax();
                $.ajax({
                    url: this.route  +"?page="+this.page ,
                    method: "POST",
                    data: dataJson,
                    beforeSend: function () {
                        loading.start();
                    },
                    success: function (result) {
                        for (var i= 0; i<result["data"].length; i++){
                            app.users.push(result["data"][i]);
                        }

                        if (result["last_page"] > app.page){
                            app.isFinish = false;
                        }
                        else {
                            app.isFinish = true;
                        }

                        var href = new URL(window.location.href);
                        href.searchParams.set('search',  app.search);
                        window.history.pushState(null, null, href.toString());
                    },
                    complete: function () {
                        loading.end();
                    },
                    dataType: "json"
                });

            }
        }
    });


</script>