
@props([
    'subject'=>null,
    'examinationPeriod'=>null,
    'classrooms'=>null,
    'startDate'=>null,
    'endDate'=>null,
])

@if($subject && $examinationPeriod)
<div class="flex py-4 flex-col justify-center items-center  bg-gray-100">
    <div class="w-full sm:max-w-md px-8 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-xl font-semibold mb-4">{{$subject->name}}</h2>
        <form  method="POST" action="{{ route('exams.store') }}">
            @csrf
            <input type="hidden" id="subject_id" name="subject_id" value={{$subject->id}}>
            <input type="hidden" id="examination_period_id" name="examination_period_id" value={{$examinationPeriod->id}}>
            <!-- Date -->
            <div>
                <x-input-label for="date" :value="'Date'" />
                <x-date-input 
                id="date" 
                class="block mt-1 w-full"  
                name="date" 
                :value="old('date')" 
                required 
                autofocus
                min="{{ $startDate }}" 
                max="{{ $endDate }}" 
                />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            
            <!-- Time -->
            <div>
                <x-input-label for="time" :value="'Time'" />
                <x-time-input id="time" class="block mt-1 w-full"  name="time" :value="old('time')" required autofocus/>
                <x-input-error :messages="$errors->get('time')" class="mt-2" />
            </div>
            <!-- Duration -->
            <div>
                <x-input-label for="duration" :value="'Duration'" />
                <x-time-input id="duration" class="block mt-1 w-full"  name="duration" :value="old('duration')" required autofocus/>
                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
            </div>
        
            <!-- Classroom -->
            <div>
                <x-input-label for="classroom_id" :value="'Classroom'" />
                <x-select-input id="classroom_id" class="block mt-1 w-full"  name="classroom_id" 
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
                <x-primary-button class="ms-3">
                    Schedule Exam
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endif