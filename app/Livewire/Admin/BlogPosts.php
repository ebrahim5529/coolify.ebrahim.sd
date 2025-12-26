<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\BlogPost;

class BlogPosts extends Component
{
    public $posts = [];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = BlogPost::latest('date')->get()->toArray();
    }

    public function delete($id)
    {
        BlogPost::findOrFail($id)->delete();
        $this->loadPosts();
        session()->flash('message', 'تم حذف المقال بنجاح');
    }

    public function render()
    {
        return view('livewire.admin.blog-posts')->layout('layouts.admin', [
            'title' => 'إدارة المدونة - لوحة التحكم',
        ]);
    }
}
