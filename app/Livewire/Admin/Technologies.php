<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Technology;

class Technologies extends Component
{
    public $technologies = [];
    public $isDialogOpen = false;
    public $editingTech = null;
    public $formData = [
        'name' => '',
        'icon' => '',
        'color' => '#000000',
        'category' => '',
        'order' => 0,
    ];

    public function mount()
    {
        $this->loadTechnologies();
    }

    public function loadTechnologies()
    {
        $this->technologies = Technology::orderBy('order')->get()->toArray();
    }

    public function openDialog($techId = null)
    {
        if ($techId) {
            $tech = Technology::find($techId);
            $this->editingTech = $tech;
            $this->formData = [
                'name' => $tech->name,
                'icon' => $tech->icon ?? '',
                'color' => $tech->color ?? '#000000',
                'category' => $tech->category ?? '',
                'order' => $tech->order ?? 0,
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
            'name' => '',
            'icon' => '',
            'color' => '#000000',
            'category' => '',
            'order' => 0,
        ];
        $this->editingTech = null;
    }

    public function save()
    {
        $this->validate([
            'formData.name' => 'required|string|max:255',
            'formData.icon' => 'nullable|string|max:500',
            'formData.color' => 'nullable|string|max:7',
            'formData.category' => 'nullable|string|max:255',
            'formData.order' => 'nullable|integer',
        ]);

        if ($this->editingTech) {
            $tech = Technology::find($this->editingTech->id);
            $tech->update($this->formData);
            session()->flash('message', 'تم تحديث التقنية بنجاح');
        } else {
            Technology::create($this->formData);
            session()->flash('message', 'تم إضافة التقنية بنجاح');
        }

        $this->loadTechnologies();
        $this->closeDialog();
    }

    public function delete($id)
    {
        Technology::findOrFail($id)->delete();
        $this->loadTechnologies();
        session()->flash('message', 'تم حذف التقنية بنجاح');
    }

    public function render()
    {
        return view('livewire.admin.technologies')->layout('layouts.admin', [
            'title' => 'إدارة التقنيات - لوحة التحكم',
        ]);
    }
}
