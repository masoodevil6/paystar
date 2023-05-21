<link rel="stylesheet" href="{{asset("customer/auth/login.css")}}">
<form method="post" action="{{route($routeName)}}" class="py-2">
    @csrf
    <section class="login-wrapper {{$backgroundColor}} rounded shadow mx-auto ">

        @if($showLogo)
            <a href="{{route("customer.home")}}" class="login-logo">
                <img src="{{ getLocationLogoSite() }}" class="logo-site">
            </a>
        @endif

        <section class="login-title {{$textColor}}">ورود / ثبت نام</section>

        <section class="login-input-text">
            <input class="px-2" type="text" name="inputLogin" placeholder="پست الکترونیک یا شماره موبایل">
            <x-input-errors field="inputLogin"/>
        </section>
        <section class="login-btn d-grid g-2">
            <button id="btn-submit-form-login" class="btn btn-warning d-block py-1  m-auto text-hover-white">ورود</button>
        </section>
        <section class="login-terms-and-conditions {{$textColor}}">
            <a href="{{route("customer.about-us")}}#rules">شرایط و قوانین</a> را خوانده ام و پذیرفته ام
        </section>

    </section>
</form>
