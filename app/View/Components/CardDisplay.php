<?php

namespace App\View\Components;

use App\Models\Call;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardDisplay extends Component
{
    public $calls;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->calls = Call::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-display');
    }
}
