<?php

namespace App\Livewire;

use App\Models\Visit;
use Livewire\Component;

class VisitorsByStageCounter extends Component
{
    public $stageVisitors = [];
    
    /**
     * Mounts the component.
     *
     * This method is responsible for fetching the initial number of visitors for each stage.
     * It initializes the `$stageVisitors` property as an empty array.
     */
    public function mount()
    {
        // Fetch the initial number of visitors for each stage
        $this->stageVisitors = Visit::groupBy('stage')
        ->select('stage', Visit::raw('count(*) as count'))
        ->pluck('count', 'stage')
        ->toArray();
    }

    /**
     * Renders the view 'livewire.visitors-by-stage-counter'.
     *
     * @return mixed
     */
    public function render()
    {
        return view('livewire.visitors-by-stage-counter');
    }
}
