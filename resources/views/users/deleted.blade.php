<x-app-layout> 
    <x-header
    :showButtons="false"
    :linkBack="route('users.index')">
        Deleted Users
    </x-header>

    @if (!$users->isEmpty())
        @include("users/partials/user-table",[
            "users"=>$users,
            "action"=>function($user){
                return view("users/partials/deleted-actions",compact('user'));
            }
        ])
    @else
        <div class="p-5 text-center">There aren't any deleted users.</div>
    @endif
    
    <x-error-modal/>
</x-app-layout>