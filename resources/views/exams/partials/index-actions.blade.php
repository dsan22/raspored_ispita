@auth
    @ifAdmin
        <a href="{{ route('exams.edit', $exam->id) }}" class="px-3">
            <x-primary-button>Edit</x-primary-button>
        </a>
        <form method="post" action="{{ route('exams.destroy', $exam->id) }}">
            @csrf
            @method('delete')
            <x-danger-button>Delete</x-danger-button>
        </form>
    @else
        @if($exam->subject->user->id == auth()->user()->id)
            <a href="/exams/{{ $exam->id }}/exam_change_requests/create">
                <x-primary-button>Request Change</x-primary-button>
            </a>
        @endif
    @endif
@endauth