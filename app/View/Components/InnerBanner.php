<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InnerBanner extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title ,
        public string $home  ,
        public string $bg
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inner-banner');
    }
}
