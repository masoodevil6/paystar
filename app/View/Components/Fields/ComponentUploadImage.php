<?php

namespace App\View\Components\Fields;

use Illuminate\View\Component;

class ComponentUploadImage extends Component
{
    public $titleEn;
    public $titleFa;
    public $full;

    public function __construct($titleEn="errorFieldInput" , $titleFa="errorFieldInput", $full=false)
    {
        $this -> titleEn = $titleEn;
        $this -> titleFa = $titleFa;
        $this -> full = $full;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.fields.component-upload-image');
    }
}
