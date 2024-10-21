<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                       
                        <th class="p-4 text-left sm:w-1/3 whitespace-nowrap">
                            Examination Period
                        </th>
                        <th class="p-4 text-left sm:w-1/3 whitespace-nowrap">
                            Starting Date
                        </th>
                        <th class="p-4 text-left sm:w-1/3 whitespace-nowrap">
                            Ending Date
                        </th>

                       
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4 sm:w-1/3 whitespace-nowrap">
                            {{ $examinationPeriod->examinationPeriodName->name }}
                        </td>
                        <td class="p-4 sm:w-1/3 whitespace-nowrap">
                            {{ $examinationPeriod->start_date }}
                        </td>
                        <td class="p-4 sm:w-1/3 whitespace-nowrap">
                            {{ $examinationPeriod->end_date }}
                        </td>
                    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>