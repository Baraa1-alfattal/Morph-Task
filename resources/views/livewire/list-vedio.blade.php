<div>
    <h1>Videos</h1>
    @if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
        <input type="text" wire:model="title" placeholder="Enter Video Title">
        @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        <button type="submit">{{ $isEditing ? 'Update' : 'Create' }}</button>
    </form>

    <ul>
        @foreach($videos as $video)
    <li>
        {{ $video->title }}
        <button wire:click="edit({{ $video->id }})">Edit</button>
        <button wire:click="delete({{ $video->id }})">Delete</button>
        <button wire:click="toggleComments({{ $video->id }})">
            {{ in_array($video->id, $activeVideoIds) ? 'Hide Comments' : 'View Comments' }}
        </button>

        @if (in_array($video->id, $activeVideoIds))
            @livewire('manage-comments', ['commentableType' => 'App\Models\VedioModel', 'commentableId' => $video->id], key($video->id))
        @endif
    </li>
@endforeach

    </ul>
</div>
