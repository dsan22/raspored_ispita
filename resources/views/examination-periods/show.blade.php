<x-app-layout>
    <x-header
    :showBack="false"
    :showAddNew="false"
    :showDeleted="false"
    :showCustomButton="true"
    textCustomButton="All examination periods"
    :linkCustomButton="route('examination_periods.index')"
    >Examination Period</x-header>

    @include("examination-periods/partials/examination-period-row",[
        "examinationPeriod"=>$examinationPeriod,
    ])

    <x-header
    :showBack="false"
    :linkNew="route('exams.schedule_exams', $examinationPeriod->id)" 
    textNew="Schedule Exams"
    :linkDeleted=" route('exams.deleted', $examinationPeriod)"
    :showButtons="auth()->check() && auth()->user()->is_admin" 
    >Exams</x-header>
    
    @if (!$examsByDepartment->isEmpty())
    @foreach ($examsByDepartment as $departmentName => $exams)
        @include('exams.partials.exam-table',[
            'exams'=>$exams,
            'departmentName'=>$departmentName,
            'action'=>function($exam) {
                return view('exams.partials.index-actions', compact('exam'));
            }
        ])
    @endforeach
    @else
        <div class="p-5 text-center">Sorry, we didn't add a schedule for this examination period.</div>
    @endif
</x-app-layout>