<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Complaint') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="p-6">
        <x-form :action="route('complaint.update')">
            <input type="hidden" name="current_status" value="{{ $model->status }}" />
            <input type="hidden" name="id" value="{{ $model->id }}" />
            @include('complaint._form')
        </x-form>
        </div>
    </x-slot>
</x-app-layout>

