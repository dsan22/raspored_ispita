<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">Create Change Request</h2>
    <form method="POST" action="{{ route('exam_change_requests.store') }}">
        @csrf

        <input type="hidden" id="exam_id" name="exam_id" value={{$exam->id}}>
        <!-- Date -->
        <div>
            <x-input-label for="new_date" :value="'New Date'" />
            <x-date-input 
            id="new_date" 
            class="block mt-1 w-full"  
            name="new_date" 
            :value="$exam->date" 
            required 
            autofocus
            min="{{ $startDate }}" 
            max="{{ $endDate }}" 
            />
            <x-input-error :messages="$errors->get('new_date')" class="mt-2" />
        </div>
        <!-- Time -->
        <div>
            <x-input-label for="new_time" :value="'New Time'" />
            <x-time-input id="new_time" class="block mt-1 w-full"  name="new_time" :value="$exam->time" required autofocus/>
            <x-input-error :messages="$errors->get('new_time')" class="mt-2" />
        </div>

        <!-- Classroom -->
        <div>
            <x-input-label for="new_classroom" :value="'New Classroom'" />
            <x-select-input id="new_classroom" class="block mt-1 w-full"  name="new_classroom" 
            :selected="$exam->classroom->id" 
            :values="
            $classrooms->map(function ($classroom) {
                return [
                    'value' => $classroom->id,
                    'name' => $classroom->name,
                ];
            })" 
            required autofocus/>
            <x-input-error :messages="$errors->get('new_classroom')" class="mt-2" />
        </div>
        

        <div class="flex items-center justify-end mt-4">
            <a href={{route('users.exams',$exam->subject->user)}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
                Send Change Request
            </x-primary-button>
        </div>
    </form>
</x-form-layout>