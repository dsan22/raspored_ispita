<x-modal name="errorModal" :show="session('error')" >
    <div class="p-9 w-full ">
        <div class="w-full flex text-center justify-center items-center">
            <div class="w-1/2">
                {{session('error')}}
            </div>
        </div>
        <div class="mt-6 w-full flex justify-end">
            <x-primary-button x-on:click="$dispatch('close')">
                Ok 
            </x-primary-button>            
        </div>
    </div>
</x-modal>