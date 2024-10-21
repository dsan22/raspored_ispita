
<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('examination_periods.show',  request()->route('examinationPeriod'))">
        Deleted Exams
    </x-header>

    @if (!$examsByDepartment->isEmpty())
        @foreach ($examsByDepartment as $departmentName => $exams)
            @include('exams.partials.exam-table',[
                'exams'=>$exams,
                'departmentName'=>$departmentName,
                'action'=>function($exam) {
                    return view('exams.partials.deleted-actions', compact('exam'));
                }
            ])
        @endforeach
    @else
        <div class="p-5 text-center">Sorry, we didn't add a schedule for this examination period.</div>
    @endif
               
    <x-error-modal/>
</x-app-layout>