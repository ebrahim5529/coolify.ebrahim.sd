<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\ContactMessage;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'blog_posts' => BlogPost::count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('read', false)->count(),
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
        ])->layout('layouts.admin', [
            'title' => 'لوحة التحكم - إدارة الموقع',
        ]);
    }
}
