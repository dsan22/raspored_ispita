<x-app-layout>
    <x-header
    :showBack="false"
    :showAddNew="false"
    :showDeleted="false"
    :showCustomButton="true"
    textCustomButton="back to examination period"
    :linkCustomButton="route('examination_periods.show', $examinationPeriod->id)"
    >Examination Period</x-header>



    @include("examination-periods/partials/examination-period-row",[
        "examinationPeriod"=>$examinationPeriod,
    ])

    <x-header
    :showBack="false"
    :showButtons="false" 
    >Schedule Exams</x-header>

    @if (!$subjectsByDepartment->isEmpty())
        @foreach ($subjectsByDepartment as $departmentName => $subjects)
            <div class=" flex flex-col justify-center items-center">
                <div class="w-full sm:max-w-md px-8 py-6 overflow-hidden sm:rounded-lg">
                    <h2 class="text-3xl font-bold">{{ $departmentName }}</h2>
                </div>
            </div>

            @foreach ($subjects as $subject)
                @include("exams.partials.exam-form",[
                    "subject"=>$subject,
                    "examinationPeriod"=>$examinationPeriod,
                    "classrooms"=>$classrooms,
                    "startDate" => $examinationPeriod->start_date->format('Y-m-d'),
                    "endDate" => $examinationPeriod->end_date->format('Y-m-d'),
                ])
                
            @endforeach
        @endforeach
    @else
        <div class="max-w-7xl pt-8 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full flex text-center justify-center items-center">
                    All exams have already been scheduled for this examination period!
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
