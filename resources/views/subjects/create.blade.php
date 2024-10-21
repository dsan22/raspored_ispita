
<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">Create New Subject</h2>

    <form  method="POST" action={{route("subjects.store")}}>
        @csrf
        <div>
            <x-input-label for="name" :value="'Name'" />
            <x-text-input id="name" class="block mt-1 w-full"  name="name" :value="old('name')" required autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="user_id" :value="'Profesor'" />
            <x-select-input id="user_id" class="block mt-1 w-full"  name="user_id" 
            :selected="old('user_id')" 
            :values="$users->map(fn($user) => ['value' => $user->id, 'name' => $user->name])" required autofocus/>
            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="department_id" :value="'Depatrment'" />
            <x-select-input id="department_id" class="block mt-1 w-full"  name="department_id" 
            :selected="old('department_id')" 
            :values="$departments->map(fn($department) => ['value' => $department->id, 'name' => $department->name])" required autofocus/> 
           
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href={{route("subjects.index")}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
                Create New Subject
            </x-primary-button>
        </div>
    </form>
</x-form-layout>