<?php

namespace App\View\Components\Forms;

use App\Models\Priority;
use App\Models\Sector;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewCall extends Component
{
    public $sectors;
    public $priorities;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sectors = Sector::all();
        $this->priorities = Priority::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.new-call', [
            'sectors' => $this->sectors,
            'priorities' => $this->priorities
        ]);
    }
}
