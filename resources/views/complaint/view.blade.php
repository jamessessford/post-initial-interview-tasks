<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Complaint') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="p-6">
                @include('complaint._view', [''])
        </div>
    </x-slot>
</x-app-layout>


