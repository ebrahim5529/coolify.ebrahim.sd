<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public function render()
    {
        $projects = Project::all();
        
        return view('livewire.projects', [
            'projects' => $projects,
        ]);
    }
}
