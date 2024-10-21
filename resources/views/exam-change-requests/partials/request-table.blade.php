<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                        
                        
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Exam
                        </th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            New Date
                        </th>
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            New Classroom
                        </th>
                        
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">
                            Status
                        </th>   
                        <th class="p-4 text-left sm:w-1/5 whitespace-nowrap">Actions</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="border-b text-gray-900">
                            
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{$request->exam->subject->name}}
                            </td>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{$request->new_date." ".$request->new_time}}
                            </td>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                {{$request->classroom->name." floor: ".$request->classroom->floor }}
                            </td>
                            
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
                                @if($request->change_approved===null)
                                    <span class="bg-gray-500 text-white rounded-full px-3 py-1">Pending</span>
                                @else
                                    @if($request->change_approved)
                                    <span class="bg-green-500 text-white rounded-full px-3 py-1">Approved</span>
                                    @else
                                    <span class="bg-red-500 text-white rounded-full px-3 py-1">Denied</span>
                                    @endif
                                @endif
                            </td>
                            <td class="p-4 sm:w-1/5 whitespace-nowrap">
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