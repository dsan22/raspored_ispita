<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="p-6 text-gray-900 w-full text-center bg-gray-200">
        <div class="w-full font-bold">
            Department: {{ $departmentName }}
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Subject</th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Date</th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Examiner</th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Classroom</th>
                        @ifAdmin
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam)
                        <tr class="border-b text-gray-900">
                            <td class="p-4 text-left sm:w-1/5 whitespace-nowrap">{{ $exam->subject->name }}</td>
                            <td class="p-4 text-left sm:w-1/5 whitespace-nowrap">{{ $exam->date . ' ' . $exam->time }}</td>
                            <td class="p-4 text-left sm:w-1/5 whitespace-nowrap">{{ $exam->subject->user->name }}</td>
                            <td class="p-4 text-left sm:w-1/5 whitespace-nowrap">{{ $exam->classroom->name . ' floor: ' . $exam->classroom->floor }}</td>
                            @ifAdmin
                            <td class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                                <div class="flex space-x-4 justify-center">
                                    <!-- Call the custom action for each subject -->
                                    {{ $action($exam) }}
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