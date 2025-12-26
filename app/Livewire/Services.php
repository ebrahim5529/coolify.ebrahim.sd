<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class Services extends Component
{
    public function render()
    {
        $services = Service::all();
        
        return view('livewire.services', [
            'services' => $services,
        ]);
    }
}
