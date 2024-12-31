<div>
    <h3>Comments</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <ul class="list-group mt-3">
        @foreach($comments as $comment)
            <li class="list-group-item">
                {{ $comment->text }}
                <button class="btn btn-sm btn-danger float-end" wire:click="deleteComment({{ $comment->id }})">Delete</button>
            </li>
        @endforeach
    </ul>

    <form wire:submit.prevent="addComment">
        <textarea wire:model="text" placeholder="Add a comment..." class="form-control mb-2"></textarea>
        @error('text') <span class="text-danger">{{ $message }}</span> @enderror
        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>


</div>
