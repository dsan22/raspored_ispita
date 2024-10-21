<x-app-layout>
    <x-header
    :showBack="false"
    :linkNew="route('examination_period_names.create')" 
    :linkDeleted="route('examination_period_names.deleted')"
    :showButtons="auth()->check() && auth()->user()->is_admin"
    >Examination Period Names</x-header>

    @if (!$examinationPeriodNames->isEmpty())
        @include("examination-period-names/partials/examination-period-name-table",[
            "examinationPeriodNames"=>$examinationPeriodNames,
            "action"=>function($examinationPeriodName){
                return view("examination-period-names/partials/index-actions",compact('examinationPeriodName'));
            }
        ])
    @else
        <div class="p-5 text-center">Create examination period name first.</div>
    @endif         
</x-app-layout>