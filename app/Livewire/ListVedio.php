<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VedioModel;

class ListVedio extends Component
{
    public $videos, $title, $videoId;
    public $isEditing = false;
    public $activeVideoIds = [];

    protected $rules = [
        'title' => 'required|string|max:255',
    ];

    public function create()
    {
        $this->validate();
        VedioModel::create(['title' => $this->title]);
        session()->flash('message', 'Video created successfully!');
        $this->title='';
    }


    public function edit($id)
    {
        $video = VedioModel::findOrFail($id);
        $this->videoId = $video->id;
        $this->title = $video->title;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
        $video = VedioModel::findOrFail($this->videoId);
        $video->update(['title' => $this->title]);
        session()->flash('message', 'Video updated successfully!');
        $this->title='';
    }

    public function delete($id)
    {
        VedioModel::findOrFail($id)->delete();
        session()->flash('message', 'Video deleted successfully!');
    }

    public function toggleComments($id)
    {
        if (in_array($id, $this->activeVideoIds)) {
            $this->activeVideoIds = array_diff($this->activeVideoIds, [$id]);
        } else {
            $this->activeVideoIds[] = $id;
        }
    }

    public function render()
    {
        $this->videos = VedioModel::all();
        return view('livewire.list-vedio')->layout('layouts.app');
    }
}
