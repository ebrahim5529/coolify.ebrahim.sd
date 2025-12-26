<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Index;
use App\Livewire\BlogList;
use App\Livewire\BlogShow;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Dashboard;

// Public Routes
Route::get('/', Index::class)->name('home');
Route::get('/blog', BlogList::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

use App\Livewire\Admin\Services;
use App\Livewire\Admin\Projects;
use App\Livewire\Admin\BlogPosts;
use App\Livewire\Admin\BlogPostForm;
use App\Livewire\Admin\ContactMessages;
use App\Livewire\Admin\Technologies;
use App\Livewire\Admin\PerformanceMonitor;

// Admin Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', Login::class)->name('admin.login');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('admin.login');
})->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/services', Services::class)->name('services');
    Route::get('/projects', Projects::class)->name('projects');
    Route::get('/blog', BlogPosts::class)->name('blog');
    Route::get('/blog/create', BlogPostForm::class)->name('blog.create');
    Route::get('/blog/{id}/edit', BlogPostForm::class)->name('blog.edit');
    Route::get('/contact', ContactMessages::class)->name('contact');
    Route::get('/technologies', Technologies::class)->name('technologies');
    Route::get('/performance', PerformanceMonitor::class)->name('performance');
});
