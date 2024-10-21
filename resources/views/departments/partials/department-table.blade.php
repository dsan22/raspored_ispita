<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                        <th class="p-4 text-left sm:w-1/2 whitespace-nowrap">Name</th>
                        @ifAdmin
                        <th class="p-4 text-left sm:w-1/2 whitespace-nowrap">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="border-b text-gray-900">
                            <td class="p-4 sm:w-1/2 whitespace-nowrap">{{ $department->name }}</td>
                            @ifAdmin
                            <td class="p-4 sm:w-1/2 whitespace-nowrap">
                                <div class="flex space-x-4 justify-center">
                                    {{ $action($department) }}
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