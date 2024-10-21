<x-app-layout>
    <x-header
    :showBack="false"
    :linkNew="route('users.create')" 
    :linkDeleted="route('users.deleted')"
    :showButtons="auth()->check() && auth()->user()->is_admin" 
    >Users</x-header>

    @if (!$users->isEmpty())
        @include("users/partials/user-table",[
            "users"=>$users,
            "action"=>function($user){
                return view("users/partials/index-actions",compact('user'));
            }
        ])
    @else
        <div class="p-5 text-center">Create user first.</div>
    @endif
    
</x-app-layout>