<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class BlogShow extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = BlogPost::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog-show', [
            'post' => $this->post,
        ])->layout('layouts.app', [
            'title' => $this->post->title . ' | إبراهيم - مطور ويب',
            'description' => $this->post->description,
        ]);
    }
}
