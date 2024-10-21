<form method="post" action="{{ route('exams.restore',$exam->id) }}">
    @csrf
    @method('PATCH')
        <x-primary-button class="ms-3 px-6">
           Restore Deleted Item
        </x-primary-button>
    
</form>

<form method="post" action="{{ route('exams.delete_permanently',$exam->id) }}">
    @csrf
    @method('delete')
        <x-danger-button class="ms-3 px-6">
           Delete Permanently
        </x-danger-button>
    
</form>