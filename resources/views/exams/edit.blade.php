
<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">{{$exam->subject->name}}</h2>
    <form  method="POST" action="{{ route('exams.update',$exam) }}">
        @csrf
        @method("PATCH")
       
        <!-- Date -->
        <div>
            <x-input-label for="date" :value="'Date'" />
            <x-date-input 
            id="date" 
            class="block mt-1 w-full"  
            name="date" 
            :value="old('date',$exam->date)" 
            required 
            autofocus
            min="{{ $startDate }}" 
            max="{{ $endDate }}" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>
        
        <!-- Time -->
        <div>
            <x-input-label for="time" :value="'Time'" />
            <x-time-input id="time" class="block mt-1 w-full"  name="time" :value="old('time',$exam->time)" required autofocus/>
            <x-input-error :messages="$errors->get('time')" class="mt-2" />
        </div>
        <!-- Duration -->
        <div>
            <x-input-label for="duration" :value="'Duration'" />
            <x-time-input id="duration" class="block mt-1 w-full"  name="duration" :value="old('duration',$exam->duration)" required autofocus/>
            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
        </div>
    
        <!-- Classroom -->
        <div>
            <x-input-label for="classroom_id" :value="'Classroom'" />
            <x-select-input id="classroom_id" class="block mt-1 w-full"  name="classroom_id" 
            :selected="old('classroom_id',$exam->classroom_id)"
            :values="
                $classrooms->map(function ($classroom) {
                return [
                    'value' => $classroom->id,
                    'name' => $classroom->name,
                ];
            })" 
            required autofocus/>
            <x-input-error :messages="$errors->get('classroom_id')" class="mt-2" />
        </div>
        
    
        <div class="flex items-center justify-end mt-4">
            <a href={{route("examination_periods.show",$exam->examinationPeriod)}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
               Update Exam
            </x-primary-button>
        </div>
    </form>

</x-form-layout>