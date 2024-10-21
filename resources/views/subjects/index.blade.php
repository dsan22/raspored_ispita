<x-app-layout>
   
    <x-header
    :showBack="false"
    :linkNew="route('subjects.create')" 
    :linkDeleted="route('subjects.deleted')"
    :showButtons="auth()->check() && auth()->user()->is_admin" 
    >Subjects</x-header>
    

    @foreach ($subjectsByDepartment as $departmentName => $subjects)
        @include('subjects.partials.subject-table',[
            'subjects'=>$subjects,
            'departmentName'=>$departmentName,
            'action'=>function($subject) {
                return view('subjects.partials.index-actions', compact('subject'));
            }
        ])
    @endforeach
  
</x-app-layout>
