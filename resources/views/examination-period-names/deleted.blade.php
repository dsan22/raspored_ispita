<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('examination_period_names.index')">
        Deleted Examination Period Names
    </x-header>
    
    @if (!$examinationPeriodNames->isEmpty())
        @include("examination-period-names/partials/examination-period-name-table",[
            "examinationPeriodNames"=>$examinationPeriodNames,
            "action"=>function($examinationPeriodName){
                return view("examination-period-names/partials/deleted-actions",compact('examinationPeriodName'));
            }
        ])
    @else
        <div class="p-5 text-center">There aren't any deleted examination period names.</div>
    @endif

    <x-error-modal/>
</x-app-layout>