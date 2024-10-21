<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('examination_periods.index')">
        Deleted Examination Periods
    </x-header>

    @if(!$examinationPeriods->isEmpty())
        @include("examination-periods/partials/examination-period-table",[
            "examinationPeriods"=>$examinationPeriods,
            "showExams"=>false,
            "action"=>function($examinationPeriod){
                return view("examination-periods/partials/deleted-actions",compact('examinationPeriod'));
            }
        ])
    @else
        <div class="p-5 text-center">There aren't any deleted examination period.</div>
    @endif

    <x-error-modal/>
</x-app-layout>