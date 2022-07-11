<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $buttonName;
    public $buttonIcon;
    public $btnColor;

    public function __construct($buttonName, $btnColor, $buttonIcon)
    {
      $this->buttonName = $buttonName;
      $this->buttonIcon = $buttonIcon;
      $this->btnColor = $btnColor;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.button-href');
    }
}
