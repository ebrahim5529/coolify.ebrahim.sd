<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Technology;

class Technologies extends Component
{
    public function render()
    {
        $technologies = Technology::all();
        
        return view('livewire.technologies', [
            'technologies' => $technologies,
        ]);
    }
}
