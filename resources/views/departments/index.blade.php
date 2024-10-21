<x-app-layout>
    <x-header
    :showBack="false"
    :linkNew="route('departments.create')" 
    :linkDeleted="route('departments.deleted')"
    :showButtons="auth()->check() && auth()->user()->is_admin" 
    >Departments</x-header>
    
    @if (!$departments->isEmpty())
        @include("departments/partials/department-table",[
            "departments"=>$departments,
            "action"=>function($department){
                return view("departments/partials/index-actions",compact('department'));
            }
        ])
    @else
        <div class="p-5 text-center">Create department first.</div>
    @endif
           
</x-app-layout>