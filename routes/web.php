<?php

use Illuminate\Support\Facades\Route;

 Route::get('/admin/blogs', App\Http\Livewire\Admin\Blog\Index::class)->name('admin.blogs');
 Route::get('/admin/blog/add', App\Http\Livewire\Admin\Blog\Add::class)->name('admin.blog.add');
 Route::get('/admin/blog/edit/{id}', App\Http\Livewire\Admin\Blog\Edit::class)->name('admin.blog.edit');

 
 
 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
