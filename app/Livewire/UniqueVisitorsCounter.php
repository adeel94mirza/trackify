<?php

namespace App\Livewire;

use App\Models\Visit;
use Livewire\Component;

class UniqueVisitorsCounter extends Component
{
    public $uniqueVisitorsCount = 0;

    /**
     * Mounts the component and fetches the initial number of unique visitors.
     *
     * @return void
     */
    public function mount()
    {
        // Fetch the initial number of unique visitors
        $this->uniqueVisitorsCount = Visit::count();
    }
    
    /**
     * Render the unique visitors counter.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.unique-visitors-counter');
    }
}
