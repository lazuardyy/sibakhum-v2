<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $attributes;
    public $placeholder;
    public $typeInput;
    public $message;
    public $note;
    public $value;

    public function __construct($attributes, $placeholder, $typeInput, $message, $note, $value)
    {
      $this->attributes = $attributes;
      $this->placeholder = $placeholder;
      $this->typeInput = $typeInput;
      $this->message = $message;
      $this->note = $note;
      $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.input');
    }
}
