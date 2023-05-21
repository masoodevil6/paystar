<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentNotExistItem extends Component
{
    public $title;
    public $showNotExist;
    public function __construct($title , $showNotExist=true)
    {
        $this->title = $title;
        $this->showNotExist = $showNotExist;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-not-exist-item');
    }
}
