<link rel="stylesheet" href="{{asset("customer/auth/login.css")}}">
<section class="login-wrapper  {{$backgroundColor}} rounded shadow mx-auto">

    <form action="{{ route($routeName, $token) }}" method="post" class="py-2">
        @csrf
        <section class=" mb-5">

            @if($showLogo)
                <a href="{{route("customer.home")}}" class="login-logo">
                    <img src="{{ getLocationLogoSite() }}" class="logo-site">
                </a>
            @endif

            <section class="login-title mb-2">
                <a href="{{ route($routeNameRegister) }}">
                    <i class="fa fa-arrow-right  {{$textColor}}"></i>
                </a>
            </section>
            <section class="login-title {{$textColor}}">
                کد تایید را وارد نمایید
            </section>

            @if($otpType == 0)
                <section class="login-info  {{$textColor}}">
                    کد تایید برای شماره موبایل {{ $otpInputLogin }} ارسال گردید
                </section>
            @else
                <section class="login-info  {{$textColor}}">
                    کد تایید برای ایمیل {{ $otpInputLogin }} ارسال گردید
                </section>
            @endif

            <section id="form-send-result">

                <section class="login-input-text">
                    <input type="text" name="otp_code" value="{{ old('otp_code') }}"/>
                    <x-input-errors field="otp_code"/>
                </section>
                <section class="login-btn d-grid g-2">
                    <button id="btn-submit-form-login" class="btn btn-warning text-hover-white d-block py-1  m-auto">تایید</button>
                </section>

            </section>


            <section id="expired-code" class="d-none">
                <section class="bg-white border border-danger text-center p-2 rounded-lg text-danger font-size-lg">
                    باطل شد
                </section>

                <section class=" {{$textColor}} font-size-lg mt-2">
                    کد اراسال شده منقضی شده است، لطفا دکمه "دریافت مجدد کدد تایید" را کلیک کنید.
                </section>
            </section>


        </section>
    </form>

    <section id="resend-otp" class="d-none">
        <form action="{{route($routeNameResendToken , $token)}}" method="post">
            @csrf
            <button type="submit"  class="btn btn-info  text-decoration-none text-white py-1 d-block m-auto ">
                دریافت مجدد کد تأیید
            </button>
        </form>
    </section>

    <section class="{{$textColor}}" id="timer"></section>

</section>

<script src="{{asset("customer/auth/login.js")}}" ></script>
<script>
    setDefaultTime({{$timerDown}});
</script>