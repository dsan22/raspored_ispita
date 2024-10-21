<a href={{route("examination_periods.edit",$examinationPeriod->id)}} class="px-6">
    <x-primary-button class="ms-3">
        Edit
     </x-primary-button>
</a>

<form method="post" action="{{ route('examination_periods.destroy',$examinationPeriod->id) }}">
    @csrf
    @method('delete')
        <x-danger-button class="ms-3 px-6">
           Delete
        </x-danger-button>
    
</form>