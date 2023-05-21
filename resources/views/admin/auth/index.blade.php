@extends('admin.layouts.master-simple')
@section("titlePage" , " ورود")

@section('head-tag')
<link rel="stylesheet" href="{{asset("admin/auth/login.css")}}">
@endsection


@section('content')

<section id="section-form-login" class="vh-100 d-flex justify-content-center align-items-center pb-5">
    <section class="login-wrapper color-family-1 rounded shadow">

        <form action="{{ route('admin-auth.commit-login') }}" method="post">
            @csrf
            <section class=" mb-5">
                <section class="login-title text-white">
                    ورود به پنل ADMIN
                </section>
                <section class="login-title text-white">
                    ایمیل کاربری
                </section>
                <section class="login-input-text">
                    <input class="px-2" type="text" name="userEmail" placeholder="ایمیل کاربری"/>
                    <x-input-errors field="password"/>
                </section>

                <section class="login-title text-white">
                    رمز عبور خود را وارد نمایید
                </section>
                <section class="login-input-text">
                    <input class="px-2" type="password" name="password" placeholder="رمز عبور خود را وارد نمایید"/>
                    <x-input-errors field="password"/>
                </section>
                <section class="login-btn d-grid g-2">
                    <button id="btn-submit-form-login" class="btn btn-warning text-hover-white d-block py-1  m-auto">تایید</button>
                </section>
            </section>
        </form>

    </section>

</section>

@endsection


