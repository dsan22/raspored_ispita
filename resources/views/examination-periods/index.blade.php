<x-app-layout>
    <x-header
    :showBack="false"
    :linkNew="route('examination_periods.create')" 
    :linkDeleted="route('examination_periods.deleted')"
    :showAddNew="auth()->check() && auth()->user()->is_admin" 
    :showDeleted="auth()->check() && auth()->user()->is_admin"
    :showCustomButton="true"
    :textCustomButton="$examinationPeriodsInFuture?'Show all examination periods':'Show upcoming examination periods'"
    :linkCustomButton="$examinationPeriodsInFuture?route('examination_periods.index'):route('examination_periods.index',['future'=>1])"
    >Examination Periods</x-header>


    @if (!$examinationPeriods->isEmpty())
    @include("examination-periods/partials/examination-period-table",[
        "examinationPeriods"=>$examinationPeriods,
        "showExams"=>true,
        "action"=>function($examinationPeriod){
            return view("examination-periods/partials/index-actions",compact('examinationPeriod'));
        }
    ])
    @else
    <div class="p-5 text-center">Create Examination period first .</div>
    @endif
    
  
</x-app-layout>