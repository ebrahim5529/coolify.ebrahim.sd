<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class Blog extends Component
{
    public function render()
    {
        $posts = BlogPost::latest()->take(3)->get();
        
        return view('livewire.blog', [
            'posts' => $posts,
        ]);
    }
}
