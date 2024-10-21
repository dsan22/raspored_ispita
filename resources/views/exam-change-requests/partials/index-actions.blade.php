@if($request->change_approved!==null)
    <form method="post" action="{{ route('exam_change_requests.destroy',$request->id) }}">
        @csrf
        @method('delete')
        <x-danger-button class="ms-3 px-6">
            Delete
        </x-danger-button>
    </form>
@endif