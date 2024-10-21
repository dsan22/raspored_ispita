<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">Update Classroom</h2>
    <form  method="POST" action={{route("classrooms.update",$classroom->id)}}>
        @csrf
        @method('PATCH')
        <div>
            <x-input-label for="name" :value="'Name'" />
            <x-text-input id="name" class="block mt-1 w-full"  name="name" :value="old('name',$classroom->name)" required autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="floor" :value="'Floor'" />
            <x-text-input type="number" id="floor" class="block mt-1 w-full"  name="floor" :value="old('floor',$classroom->floor)" required autofocus/>
            <x-input-error :messages="$errors->get('floor')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href={{route("classrooms.index")}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
                Update Classroom
            </x-primary-button>
        </div>
    </form>
</x-form-layout>