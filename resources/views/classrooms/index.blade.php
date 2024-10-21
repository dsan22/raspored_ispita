<x-app-layout>
    <x-header
    :showBack="false"
    :linkNew="route('classrooms.create')" 
    :linkDeleted="route('classrooms.deleted')"
    :showButtons="auth()->check() && auth()->user()->is_admin" 
    >Classrooms</x-header>

    @if (!$classrooms->isEmpty())
        @include("classrooms/partials/classroom-table",[
            "classrooms"=>$classrooms,
            "action"=>function($classroom){
                return view("classrooms/partials/index-actions",compact('classroom'));
            }
        ])
    @else
        <div class="p-5 text-center">Create classroom first.</div>
    @endif
           

</x-app-layout>