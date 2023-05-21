<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentRegisterClient extends Component
{
    public $routeName;
    public $showLogo;
    public $backgroundColor;
    public $textColor;
    public function __construct($routeName = "auth.customer.loginRegister" , $showLogo=true , $backgroundColor = "color-family-1" , $textColor="text-white")
    {
        $this-> routeName = $routeName;
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
        return view('components.component-register-client');
    }
}
