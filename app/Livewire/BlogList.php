<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class BlogList extends Component
{
    public function render()
    {
        $posts = BlogPost::where('published', true)
            ->latest('date')
            ->get();
        
        return view('livewire.blog-list', [
            'posts' => $posts,
        ])->layout('layouts.app', [
            'title' => 'المدونة التقنية - مقالات في تطوير الويب والبرمجة | إبراهيم',
            'description' => 'اكتشف أحدث المقالات والنصائح في تطوير الويب، البرمجة، Laravel، React، وتحسين الأداء. محتوى عربي احترافي لمطوري الويب.',
        ]);
    }
}
