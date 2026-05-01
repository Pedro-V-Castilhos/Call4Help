<?php

namespace App\View\Components\Forms;

use App\Models\Sector;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewSector extends Component
{
    public $sectors;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sectors = Sector::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.new-sector');
    }
}
