<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WriterCard extends Component
{
    public $writer;
    /**
     * Create a new component instance.
     */
    public function __construct($writer)
    {
        $this->writer = $writer; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.writer_card');
    }
}
