<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ListPost;
use App\Livewire\ListVedio;
use App\Livewire\ManageComments;


Route::view('/', 'layouts.app', ['slot' => '']);

Route::get('/posts', ListPost::class)->name('posts');
Route::get('/videos', ListVedio::class)->name('videos');

Route::get('/posts/{post}/comments', ManageComments::class)->name('post.comments');
Route::get('/videos/{video}/comments', ManageComments::class)->name('video.comments');
