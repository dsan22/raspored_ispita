<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center  bg-gray-100">
        <div class="w-full sm:max-w-md px-8 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>