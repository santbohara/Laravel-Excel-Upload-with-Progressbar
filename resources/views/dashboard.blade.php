<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="my-6 max-w-7xl mx-auto w-full">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white p-3 text-sm">
                @livewire('import-excel')
            </div>
        </div>
    </div>
</x-app-layout>
