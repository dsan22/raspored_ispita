<form method="post" action="{{ route('users.destroy',$user->id) }}">
    @csrf
    @method('delete')
        <x-danger-button class="ms-3 px-6">
            Delete
        </x-danger-button>
    
</form>