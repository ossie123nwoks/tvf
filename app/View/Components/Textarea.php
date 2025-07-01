<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $id = '',
        public string $rows = '3',
        public string $value = '',
    ) {
        if (empty($this->id)) {
            $this->id = $this->name;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.textarea');
    }
}