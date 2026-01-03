<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\BlogPost;
use Livewire\WithFileUploads;

class BlogPosts extends Component
{
    use WithFileUploads;

    public $posts = [];
    public $isDialogOpen = false;
    public $editingPost = null;
    public $formData = [
        'title' => '',
        'slug' => '',
        'excerpt' => '',
        'content' => '',
        'image' => null,
        'date' => '',
        'tags' => '',
    ];

    protected $rules = [
        'formData.title' => 'required|string|max:255',
        'formData.slug' => 'required|string|max:255|unique:blog_posts,slug',
        'formData.excerpt' => 'required|string|max:500',
        'formData.content' => 'required|string',
        'formData.image' => 'nullable|image|max:2048',
        'formData.date' => 'required|date',
        'formData.tags' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'formData.title.required' => 'عنوان المقال مطلوب',
        'formData.slug.required' => 'الرابط المختصر مطلوب',
        'formData.slug.unique' => 'الرابط المختصر موجود بالفعل',
        'formData.excerpt.required' => 'الملخص مطلوب',
        'formData.content.required' => 'محتوى المقال مطلوب',
        'formData.date.required' => 'تاريخ النشر مطلوب',
        'formData.image.image' => 'يجب أن تكون الصورة من نوع صحيح',
        'formData.image.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجابايت',
    ];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = BlogPost::latest('date')->get()->toArray();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->editingPost = null;
        $this->isDialogOpen = true;
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->editingPost = $post;
        $this->formData = [
            'title' => $post->title,
            'slug' => $post->slug,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'image' => null,
            'date' => $post->date,
            'tags' => $post->tags,
        ];
        $this->isDialogOpen = true;
    }

    public function save()
    {
        if ($this->editingPost) {
            $this->rules['formData.slug'] = 'required|string|max:255|unique:blog_posts,slug,' . $this->editingPost->id;
        }

        $this->validate();

        $data = [
            'title' => $this->formData['title'],
            'slug' => $this->formData['slug'],
            'excerpt' => $this->formData['excerpt'],
            'content' => $this->formData['content'],
            'date' => $this->formData['date'],
            'tags' => $this->formData['tags'],
        ];

        if ($this->formData['image']) {
            $data['image'] = $this->formData['image']->store('blog', 'public');
        }

        if ($this->editingPost) {
            $this->editingPost->update($data);
            session()->flash('message', 'تم تحديث المقال بنجاح');
        } else {
            BlogPost::create($data);
            session()->flash('message', 'تم إضافة المقال بنجاح');
        }

        $this->loadPosts();
        $this->open = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        BlogPost::findOrFail($id)->delete();
        $this->loadPosts();
        session()->flash('message', 'تم حذف المقال بنجاح');
    }

    public function resetForm()
    {
        $this->formData = [
            'title' => '',
            'slug' => '',
            'excerpt' => '',
            'content' => '',
            'image' => null,
            'date' => date('Y-m-d'),
            'tags' => '',
        ];
        $this->resetValidation();
    }

    public function updatedFormDataTitle()
    {
        if (!$this->editingPost && empty($this->formData['slug'])) {
            $this->formData['slug'] = $this->generateSlug($this->formData['title']);
        }
    }

    private function generateSlug($title)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($title)));
    }

    public function render()
    {
        return view('livewire.admin.blog-posts')->layout('layouts.admin', [
            'title' => 'إدارة المدونة - لوحة التحكم',
        ]);
    }
}
