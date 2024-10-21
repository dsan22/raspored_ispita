@props([
    'showDeleted' => true,
    'showAddNew' => true,
    'showBack' => true,
    'showCustomButton'=>false,
    'showButtons' => true,
    'textDeleted' => "Show Deleted",
    'textCustomButton' => "Button",
    'textNew' => "+ Create New",
    'linkNew' => "",
    'linkDeleted' => "",
    'linkBack' => "",
    'linkCustomButton' => "",
    
    ])

<div class="max-w-7xl pt-8 mx-auto sm:px-6 lg:px-8 py-3">
    <div class="px-6 text-gray-900 w-full ">
        <div class="font-semibold text-4xl text-gray-800 leading-tight flex items-center justify-center sm:justify-start">
            @if($showBack)
            <a href="{{$linkBack}}">
                <button class="px-2 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7M3 12h18" />
                    </svg>
                </button>
            </a>
            @endif
            <div class="flex1 justify-center space-x-4 sm:justify-start">
                {{ $slot }}
            </div>
        </div>
        
    </div>
    @if($showButtons)
    <div class="py-3 px-6 flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:space-x-4 sm:justify-start">
        @if($showAddNew)
        <a href={{$linkNew}} class="w-full sm:w-auto">
            <x-green-button class="w-full flex justify-center items-center">{{$textNew}}</x-green-button>
        </a>
        @endif
        @if($showDeleted)
        <a href={{$linkDeleted}} class="w-full sm:w-auto">
            <x-danger-button class="w-full flex justify-center items-center">{{$textDeleted}}</x-danger-button>
        </a>
        @endif
        @if($showCustomButton)
        <a href={{$linkCustomButton}} class="w-full sm:w-auto">
            <x-primary-button class="w-full flex justify-center items-center">{{$textCustomButton}}</x-primary-button>
        </a>
        @endif
    </div>
    @endif
</div>