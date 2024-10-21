<x-app-layout>
    <x-header
    :showButtons="false"
    :showBack="false">
        Requests
    </x-header>
    @if (!$examChangeRequests->isEmpty())
    @include("exam-change-requests/partials/request-table",[
        "requests"=>$examChangeRequests,
        "action"=>function($request){
            return view("exam-change-requests/partials/user-actions",compact('request'));
        }
    ])
    @else
        <div class="p-5 text-center">You don't have open requests.</div>
    @endif
  
</x-app-layout>