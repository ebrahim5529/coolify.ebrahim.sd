<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class BlogPostForm extends Component
{
    public $postId = null;
    public $formData = [
        'title' => '',
        'slug' => '',
        'description' => '',
        'content' => '',
        'image' => '',
        'category' => '',
        'date' => '',
        'read_time' => '',
        'keywords' => '',
        'published' => true,
    ];

    public function mount($id = null)
    {
        $this->postId = $id;
        $this->formData['date'] = now()->format('Y-m-d');
        
        if ($id) {
            $post = BlogPost::findOrFail($id);
            $this->formData = [
                'title' => $post->title,
                'slug' => $post->slug,
                'description' => $post->description,
                'content' => $post->content ?? '',
                'image' => $post->image ?? '',
                'category' => $post->category ?? '',
                'date' => $post->date ? date('Y-m-d', strtotime($post->date)) : now()->format('Y-m-d'),
                'read_time' => $post->read_time ?? '',
                'keywords' => $post->keywords ?? '',
                'published' => $post->published ?? true,
            ];
        }
    }

    public function updatedFormDataTitle()
    {
        if (!$this->postId) {
            $this->formData['slug'] = Str::slug($this->formData['title']);
        }
    }

    public function save()
    {
        $this->validate([
            'formData.title' => 'required|string|max:255',
            'formData.slug' => 'required|string|max:255|unique:blog_posts,slug,' . ($this->postId ?? ''),
            'formData.description' => 'required|string',
            'formData.content' => 'required|string',
            'formData.category' => 'required|string|max:255',
            'formData.date' => 'required|date',
            'formData.read_time' => 'nullable|string|max:50',
            'formData.keywords' => 'nullable|string|max:500',
            'formData.published' => 'boolean',
        ]);

        if ($this->postId) {
            $post = BlogPost::findOrFail($this->postId);
            $post->update($this->formData);
            session()->flash('message', 'تم تحديث المقال بنجاح');
        } else {
            BlogPost::create($this->formData);
            session()->flash('message', 'تم إضافة المقال بنجاح');
        }

        return redirect()->route('admin.blog');
    }

    public function render()
    {
        return view('livewire.admin.blog-post-form')->layout('layouts.admin', [
            'title' => ($this->postId ? 'تعديل المقال' : 'إضافة مقال جديد') . ' - لوحة التحكم',
        ]);
    }
}




