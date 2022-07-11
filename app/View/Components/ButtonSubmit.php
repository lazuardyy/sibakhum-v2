<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonSubmit extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $attributes;
    public $buttonName;
    public $buttonIcon;
    public $buttonColor;

    public function __construct($attributes, $buttonName, $buttonIcon, $buttonColor)
    {
      $this->attributes = $attributes;
      $this->buttonName = $buttonName;
      $this->buttonIcon = $buttonIcon;
      $this->buttonColor = $buttonColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.button-submit');
    }
}
