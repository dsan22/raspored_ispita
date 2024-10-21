<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('subjects.index')">
        Deleted Subjects
    </x-header>
   
    @if(!$subjectsByDepartment->isEmpty())
        @foreach ($subjectsByDepartment as $departmentName => $subjects)
            @include('subjects.partials.subject-table',[
                'subjects'=>$subjects,
                'departmentName'=>$departmentName,
                'action'=>function($subject) {
                    return view('subjects.partials.deleted-actions', compact('subject'));
                }
            ])
        @endforeach
    @else
        <div class="p-5 text-center">There is no deleted subjects .</div>
    @endif
            
    <x-error-modal/>

</x-app-layout>