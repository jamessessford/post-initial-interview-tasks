<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complaints') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <livewire:complaint-table buttonsSlot="complaint.buttons"/>
    </x-slot>
</x-app-layout>
