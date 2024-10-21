<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-900">
                        <th class="p-4 text-left sm:w-1/4 whitespace-nowrap">
                        Name
                        </th>
                        <th class="p-4 text-left sm:w-1/4 whitespace-nowrap">
                            Email
                        </th>
                        <th class="p-4 text-left sm:w-1/4 whitespace-nowrap">
                            Role
                        </th>
                        @ifAdmin
                        <th class="p-4 text-left sm:w-1/4 whitespace-nowrap">
                            Actions
                        </th>
                         @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b text-gray-900">
                            <td class="p-4 sm:w-1/4 whitespace-nowrap">
                                {{$user->name}}
                            </td>
                            <td class="p-4 sm:w-1/4 whitespace-nowrap">
                                {{$user->email}}
                            </td>
                            <td class="p-4 sm:w-1/4 whitespace-nowrap">
                                @if($user->is_admin)
                                    <span class="bg-red-500 text-white rounded-full px-3 py-1">Admin</span>
                                @else
                                    <span class="bg-green-500 text-white rounded-full px-3 py-1">User</span>
                                @endif
                            </td>
                            @ifAdmin
                            <td class="p-4 sm:w-1/4 whitespace-nowrap">
                                <div class="flex space-x-4 justify-center">
                                    {{ $action($user) }}
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