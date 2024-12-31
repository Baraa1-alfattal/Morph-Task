<div>
    <h1>Posts</h1>
    @if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
        <input type="text" wire:model="title" placeholder="Enter Post Title">
        @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        <button type="submit">{{ $isEditing ? 'Update' : 'Create' }}</button>
    </form>

    <ul>
        @foreach($posts as $post)
            <li>
                {{ $post->title }}
                <button wire:click="edit({{ $post->id }})">Edit</button>
                <button wire:click="delete({{ $post->id }})">Delete</button>
                <button wire:click="toggleComments({{ $post->id }})">
                    {{ in_array($post->id, $activePostIds) ? 'Hide Comments' : 'View Comments' }}
                </button>
            </li>
            @if (in_array($post->id, $activePostIds))
            @livewire('manage-comments', ['commentableType' => 'App\Models\PostModel', 'commentableId' => $post->id], key($post->id))
            @endif
            @endforeach
    </ul>
</div>
