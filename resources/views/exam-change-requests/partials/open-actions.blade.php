
<form class="w-1/2 me-3 " method="post" action="{{ route('exam_change_requests.approve',$request->id) }}">
    @csrf
    @method('patch')
    <x-green-button class="ms-3">
        Approve
    </x-green-button>
</form>
<form class="w-1/2" method="post" action="{{ route('exam_change_requests.denie',$request->id) }}">
    @csrf
    @method('patch')
    <x-danger-button class="ms-3">
        Deny
    </x-danger-button>
</form>
  