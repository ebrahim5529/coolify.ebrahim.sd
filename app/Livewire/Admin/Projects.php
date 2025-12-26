<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public $projects = [];
    public $isDialogOpen = false;
    public $editingProject = null;
    public $formData = [
        'title' => '',
        'description' => '',
        'image' => '',
        'technologies' => [],
        'demo_url' => '',
        'github_url' => '',
        'order' => 0,
    ];
    public $techInput = '';

    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->projects = Project::orderBy('order')->get()->map(function ($project) {
            $project->technologies = is_string($project->technologies) 
                ? json_decode($project->technologies, true) ?? []
                : ($project->technologies ?? []);
            return $project->toArray();
        })->toArray();
    }

    public function openDialog($projectId = null)
    {
        if ($projectId) {
            $project = Project::find($projectId);
            $this->editingProject = $project;
            $this->formData = [
                'title' => $project->title,
                'description' => $project->description,
                'image' => $project->image ?? '',
                'technologies' => is_string($project->technologies) 
                    ? json_decode($project->technologies, true) ?? []
                    : ($project->technologies ?? []),
                'demo_url' => $project->demo_url ?? '',
                'github_url' => $project->github_url ?? '',
                'order' => $project->order ?? 0,
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
            'image' => '',
            'technologies' => [],
            'demo_url' => '',
            'github_url' => '',
            'order' => 0,
        ];
        $this->techInput = '';
        $this->editingProject = null;
    }

    public function addTech()
    {
        if (trim($this->techInput)) {
            $this->formData['technologies'][] = trim($this->techInput);
            $this->techInput = '';
        }
    }

    public function removeTech($index)
    {
        unset($this->formData['technologies'][$index]);
        $this->formData['technologies'] = array_values($this->formData['technologies']);
    }

    public function save()
    {
        $this->validate([
            'formData.title' => 'required|string|max:255',
            'formData.description' => 'required|string',
            'formData.image' => 'nullable|string|max:500',
            'formData.demo_url' => 'nullable|url|max:500',
            'formData.github_url' => 'nullable|url|max:500',
            'formData.order' => 'nullable|integer',
        ]);

        $data = $this->formData;
        $data['technologies'] = json_encode($data['technologies']);

        if ($this->editingProject) {
            $project = Project::find($this->editingProject->id);
            $project->update($data);
            session()->flash('message', 'تم تحديث المشروع بنجاح');
        } else {
            Project::create($data);
            session()->flash('message', 'تم إضافة المشروع بنجاح');
        }

        $this->loadProjects();
        $this->closeDialog();
    }

    public function delete($id)
    {
        Project::findOrFail($id)->delete();
        $this->loadProjects();
        session()->flash('message', 'تم حذف المشروع بنجاح');
    }

    public function render()
    {
        return view('livewire.admin.projects')->layout('layouts.admin', [
            'title' => 'إدارة المشاريع - لوحة التحكم',
        ]);
    }
}
