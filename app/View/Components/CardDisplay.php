<?php

namespace App\View\Components;

use App\Models\Call;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardDisplay extends Component
{
    public $callsOpened;
    public $sectorCalls;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = auth()->user();
        if($user->worker) {
            $this->sectorCalls = Call::all()->where('sector_id', $user->worker->sector_id)->sortByDesc('created_at');
        }

        $this->callsOpened = Call::all()->where('user_id', $user->id)->sortByDesc('created_at');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-display');
    }
}
