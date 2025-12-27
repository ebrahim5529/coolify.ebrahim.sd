<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class Services extends Component
{
    public function render()
    {
        try {
            $services = Service::all();
        } catch (\Exception $e) {
            // في حالة فشل الاتصال بقاعدة البيانات، نعيد مصفوفة فارغة
            $services = collect([]);
        }
        
        return view('livewire.services', [
            'services' => $services,
        ]);
    }
}
