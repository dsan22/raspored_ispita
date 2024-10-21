<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('departments.index')">
        Deleted Departments
    </x-header>

    @if (!$departments->isEmpty())
        @include("departments/partials/department-table",[
            "departments"=>$departments,
            "action"=>function($department){
                return view("departments/partials/deleted-actions",compact('department'));
            }
        ])
    @else
        <div class="p-5 text-center">There aren't any deleted departments.</div>
    @endif
    
    <x-error-modal/>
</x-app-layout>