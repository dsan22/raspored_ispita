<form method="post" action="{{ route('subjects.restore',$subject->id) }}">
    @csrf
    @method('PATCH')
        <x-primary-button class="ms-3 px-6">
            Restore Deleted Item
        </x-primary-button>
    
</form>

<form method="post" action="{{ route('subjects.delete_permanently',$subject->id) }}">
    @csrf
    @method('delete')
        <x-danger-button class="ms-3 px-6">
            Delete Permanently
        </x-danger-button>
    
</form>
