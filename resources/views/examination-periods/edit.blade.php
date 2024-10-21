<x-form-layout>
    <h2 class="text-xl font-semibold mb-4">Update Examination Period</h2>
    <form method="POST" action="{{ route('examination_periods.update',$examinationPeriod->id) }}">
        @csrf
        @method("PATCH")
    
        <!--Start Date -->
        <div>
            <x-input-label for="start_date" :value="'Start Date'" />
            <x-date-input id="start_date" class="block mt-1 w-full"  name="start_date" :value="old('start_date',$examinationPeriod->start_date->format('Y-m-d'))" required autofocus/>
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>
        <!--End Date -->
        <div>
            <x-input-label for="end_date" :value="'End Date'" />
            <x-date-input id="end_date" class="block mt-1 w-full"  name="end_date" :value="old('end_date',$examinationPeriod->end_date->format('Y-m-d'))" required autofocus/>
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>
    
        <!-- Name -->
        <div>
            <x-input-label for="examination_period_name_id	" :value="'Name'" />
            <x-select-input id="examination_period_name_id	" class="block mt-1 w-full"  name="examination_period_name_id" 
            :selected="old('end_date',$examinationPeriod->examination_period_name_id)" 
            :values="
                $examinationPeriodNames->map(function ($examinationPeriodName) {
                return [
                    'value' => $examinationPeriodName->id,
                    'name' => $examinationPeriodName->name,
                ];
            })" 
            required autofocus/>
            <x-input-error :messages="$errors->get('examination_period_name_id')" class="mt-2" />
        </div>
        
    
        <div class="flex items-center justify-end mt-4">
            <a href={{route("examination_periods.index")}}>
                <x-danger-button type="button" class="ms-3">
                    Cancel
                </x-danger-button>
            </a>
            <x-primary-button class="ms-3">
            Update Examination Period
            </x-primary-button>
        </div>
    </form>

</x-form-layout>