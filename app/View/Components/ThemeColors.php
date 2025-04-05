<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ThemeColors extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($variant = 'primary')
    {
        $this->variant = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.theme-colors');
    }

    
}
