<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PostModel;
class ListPost extends Component
{
    public $posts, $title, $postId;
    public $isEditing = false;
    public $activePostIds = [];


    protected $rules = [
        'title' => 'required|string|max:255',
    ];

    public function create()
    {
        $this->validate();
        PostModel::create(['title' => $this->title]);
        session()->flash('message', 'Post created successfully!');
        $this->title='';
    }

    public function edit($id)
    {
        $post = PostModel::findOrFail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
        $post = PostModel::findOrFail($this->postId);
        $post->update(['title' => $this->title]);
        session()->flash('message', 'Post updated successfully!');
        $this->title='';
    }

    public function delete($id)
    {
        PostModel::findOrFail($id)->delete();
        session()->flash('message', 'Post deleted successfully!');
    }


    public function toggleComments($id)
    {
        if (in_array($id, $this->activePostIds)) {
            $this->activePostIds = array_diff($this->activePostIds, [$id]);
        } else {
            $this->activePostIds[] = $id;
        }
    }

    public function render()
    {
        $this->posts = PostModel::all();
        return view('livewire.list-post')->layout('layouts.app');
    }
}
