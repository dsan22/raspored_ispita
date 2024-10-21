<x-app-layout>
    <x-header
    :showButtons="false"
    :linkBack="route('classrooms.index')">
        Deleted Classrooms
    </x-header>

    @if (!$classrooms->isEmpty())
        @include("classrooms/partials/classroom-table",[
            "classrooms"=>$classrooms,
            "action"=>function($classroom){
                return view("classrooms/partials/deleted-actions",compact('classroom'));
            }
        ])
    @else
        <div class="p-5 text-center">There aren't any deleted classrooms.</div>
    @endif

    <x-error-modal/>
</x-app-layout>