<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">Create New Department</h2>
    <form  method="POST" action={{route("departments.store")}}>
        @csrf
        <div>
            <x-input-label for="name" :value="'Name'" />
            <x-text-input id="name" class="block mt-1 w-full"  name="name" :value="old('name')" required autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href={{route("departments.index")}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
                Create New Department
            </x-primary-button>
        </div>
    </form>
</x-form-layout>