<a href="{{ route('subjects.edit', $subject->id) }}">
    <x-primary-button>Edit</x-primary-button>
</a>
<form method="post" action="{{ route('subjects.destroy', $subject->id) }}">
    @csrf
    @method('delete')
    <x-danger-button>Delete</x-danger-button>
</form>