@if($request->change_approved===null)
    <a href={{route("exam_change_requests.edit",$request->id)}} class="px-6">
        <x-primary-button class="ms-3">
            Edit
        </x-primary-button>
    </a>

    <form method="post" action="{{ route('exam_change_requests.destroy',$request->id) }}">
        @csrf
        @method('delete')
        <x-danger-button class="ms-3 pe-3">
            Cancel
        </x-danger-button>
    
    </form>      
@endif