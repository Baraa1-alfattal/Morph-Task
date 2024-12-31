<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\CommentModel;

class ManageComments extends Component
{
    public $commentableType;
    public $commentableId;
    public $comments=[];
    public $text;

    protected $rules = [
        'text' => 'required|string|max:500',
    ];

    public function mount($commentableType, $commentableId)
    {
        // dd($commentableType, $commentableId);
        $this->commentableType = $commentableType;
        $this->commentableId = $commentableId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = CommentModel::where('commentable_type', $this->commentableType)
            ->where('commentable_id', $this->commentableId)
            ->get();
    }

    public function addComment()
    {
        $this->validate();
        CommentModel::create([
            'text' => $this->text,
            'commentable_type' => $this->commentableType,
            'commentable_id' => $this->commentableId,
        ]);

        $this->text = '';
        session()->flash('message', 'Comment added successfully!');
        $this->loadComments();
    }

    public function deleteComment($id)
{
    $comment = CommentModel::where('id', $id)
        ->where('commentable_type', $this->commentableType)
        ->where('commentable_id', $this->commentableId)
        ->firstOrFail();

    $comment->delete();
    session()->flash('message', 'Comment deleted successfully!');
    $this->loadComments();
}


    public function render()
    {
        return view('livewire.manage-comments');
    }
}
