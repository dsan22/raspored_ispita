<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                       
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Examination Period
                        </th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Starting Date
                        </th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Ending Date
                        </th>
                        @if($showExams)
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Exams
                        </th>
                        @endif
                  
                        @ifAdmin
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examinationPeriods as $examinationPeriod)
                        <tr>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{ $examinationPeriod->examinationPeriodName->name }}
                            </td>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{ $examinationPeriod->start_date }}
                            </td>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{ $examinationPeriod->end_date }}
                            </td>
                            @if($showExams)
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                              <a href={{route("examination_periods.show",$examinationPeriod->id)}}>  
                                <x-secondary-button class="ms-3">
                                    Show Exams
                                </x-secondary-button>
                                </a>  
                            </td>
                            @endif
                            
                            @ifAdmin
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                <div class="flex space-x-4 justify-center">
                                    {{ $action($examinationPeriod) }}
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>