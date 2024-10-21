<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">    
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">
                            Exam
                        </th>
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">
                            Date
                        </th>
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">
                            Classroom
                        </th>
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">
                            New Date
                        </th>
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">
                            New Classroom
                        </th>
                         
                        <th class="p-4 text-left sm:w-1/6 whitespace-nowrap">Actions</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="border-b text-gray-900">  
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                {{$request->exam->subject->name}}
                            </td>
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                {{$request->exam->date." ".$request->exam->time}}
                            </td>
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                {{$request->exam->classroom->name." floor: ".$request->exam->classroom->floor }}
                            </td>
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                {{$request->new_date." ".$request->new_time}}
                            </td>
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                {{$request->classroom->name." floor: ".$request->classroom->floor }}
                            </td>
                        
                            <td class="p-4 sm:w-1/6 whitespace-nowrap">
                                <div class="flex space-x-4 justify-center">
                                    {{ $action($request) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>