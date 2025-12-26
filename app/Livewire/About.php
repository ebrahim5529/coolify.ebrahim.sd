<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalInfo;

class About extends Component
{
    public function render()
    {
        $personalInfo = PersonalInfo::first();
        
        return view('livewire.about', [
            'personalInfo' => $personalInfo,
        ]);
    }
}
