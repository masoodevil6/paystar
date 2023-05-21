<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentConfirmClient extends Component
{

    public $routeName;
    public $routeNameRegister;
    public $routeNameResendToken;
    public $token;
    public $otpType;
    public $otpInputLogin;
    public $timerDown;
    public $showLogo;
    public $backgroundColor;
    public $textColor;
    public function __construct(
        $routeName = "auth.customer.loginConfirm" ,
        $routeNameRegister = "auth.customer.loginRegisterForm" ,
        $routeNameResendToken = "auth.customer.resendToken" ,
        $token = "",
        $otpType = 0,
        $otpInputLogin = "",
        $timerDown = 0,
        $showLogo=true ,
        $backgroundColor = "color-family-1" ,
        $textColor="text-white")
    {
        $this-> routeName = $routeName;
        $this-> routeNameRegister = $routeNameRegister;
        $this-> routeNameResendToken = $routeNameResendToken;
        $this-> token = $token;
        $this-> otpType = $otpType;
        $this-> otpInputLogin = $otpInputLogin;
        $this-> timerDown = $timerDown;
        $this-> showLogo = $showLogo;
        $this-> backgroundColor = $backgroundColor;
        $this-> textColor = $textColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-confirm-client');
    }
}
