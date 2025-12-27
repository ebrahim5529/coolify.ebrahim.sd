<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public function render()
    {
        try {
            $projects = Project::all();
        } catch (\Exception $e) {
            $projects = collect([]);
        }
        
        return view('livewire.projects', [
            'projects' => $projects,
        ]);
    }
}
