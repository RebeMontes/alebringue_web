<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public $links;

    public function __construct($links = [])
    {
        $this->links = $links;
    }

    public function render()
    {
        return view('components.breadcrumbs');
    }
}
