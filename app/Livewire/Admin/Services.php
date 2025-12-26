<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Validation\ValidationException;

class Services extends Component
{
    public $services = [];
    public $isDialogOpen = false;
    public $editingService = null;
    public $formData = [
        'title' => '',
        'description' => '',
        'icon' => 'Code',
        'order' => 0,
    ];

    public function mount()
    {
        $this->loadServices();
    }

    public function loadServices()
    {
        $this->services = Service::orderBy('order')->get()->toArray();
    }

    public function openDialog($serviceId = null)
    {
        if ($serviceId) {
            $service = Service::find($serviceId);
            $this->editingService = $service;
            $this->formData = [
                'title' => $service->title,
                'description' => $service->description,
                'icon' => $service->icon ?? 'Code',
                'order' => $service->order ?? 0,
            ];
        } else {
            $this->resetForm();
        }
        $this->isDialogOpen = true;
    }

    public function closeDialog()
    {
        $this->isDialogOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->formData = [
            'title' => '',
            'description' => '',
            'icon' => 'Code',
            'order' => 0,
        ];
        $this->editingService = null;
    }

    public function save()
    {
        $this->validate([
            'formData.title' => 'required|string|max:255',
            'formData.description' => 'required|string',
            'formData.icon' => 'nullable|string|max:255',
            'formData.order' => 'nullable|integer',
        ]);

        if ($this->editingService) {
            $service = Service::find($this->editingService->id);
            $service->update($this->formData);
            session()->flash('message', 'تم تحديث الخدمة بنجاح');
        } else {
            Service::create($this->formData);
            session()->flash('message', 'تم إضافة الخدمة بنجاح');
        }

        $this->loadServices();
        $this->closeDialog();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        $this->loadServices();
        session()->flash('message', 'تم حذف الخدمة بنجاح');
    }

    public function render()
    {
        return view('livewire.admin.services')->layout('layouts.admin', [
            'title' => 'إدارة الخدمات - لوحة التحكم',
        ]);
    }
}
