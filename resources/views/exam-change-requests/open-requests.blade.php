<x-app-layout>
    <x-header
    :showBack="false"
    :showAddNew="false"
    :showDeleted="false"
    :showCustomButton="true"
    textCustomButton="Show all requests"
    :linkCustomButton="route('exam_change_requests.index')"
    >Open Requests</x-header>

    @if (!$examChangeRequests->isEmpty())
        @include("exam-change-requests/partials/open-request-table",[
            "requests"=>$examChangeRequests,
            "action"=>function($request){
                return view("exam-change-requests/partials/open-actions",compact('request'));
            }
        ])
    @else
        <div class="p-5 text-center">There are currently no open requests.</div>
    @endif    
</x-app-layout>