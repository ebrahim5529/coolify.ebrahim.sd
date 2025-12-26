<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PerformanceMonitor extends Component
{
    public function render()
    {
        return view('livewire.admin.performance-monitor')->layout('layouts.admin', [
            'title' => 'قياس الأداء - لوحة التحكم',
        ]);
    }
}
