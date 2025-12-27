<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalInfo;

class About extends Component
{
    public function render()
    {
        try {
            $personalInfo = PersonalInfo::first();
        } catch (\Exception $e) {
            $personalInfo = null;
        }
        
        return view('livewire.about', [
            'personalInfo' => $personalInfo,
        ]);
    }
}
