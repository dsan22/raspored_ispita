<x-app-layout>
    <x-header
    :showBack="false"
    :showButtons="false"
    >Your Exams</x-header>

    @if (!$examsByExaminationPeriod->isEmpty())
        @foreach ($examsByExaminationPeriod as $examinationPeriodName => $exams)
            @include('exams.partials.users-exams-table',[
                'exams'=>$exams,
                'examinationPeriod'=>$examinationPeriodName,
                'action'=>function($exam) {
                    return view('exams.partials.user-actions', compact('exam'));
                }
            ])
        @endforeach
    @else
        <div class="p-5 text-center">You dont have upcoming exams</div>
    @endif
</x-app-layout>