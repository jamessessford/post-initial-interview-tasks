<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a  Note') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="p-6">
            <x-form :action="route('note.create')">
                <div>{{ $complaint->title }}</div>
                <x-form-textarea required name="note" label="Note"/>
                <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                <input type="hidden" name="complaint_id" value="{{ $complaint->id }}"/>
                <input type="hidden" name="noteable_id" value="{{ $complaint->id }}"/>
                <input type="hidden" name="noteable_type" value="{{ \App\Models\Complaint::class }}"/>
                <div class="p-2 flex">
                    <div class="w-1/2 flex justify-end">
                        <a href="{{ route('complaint.view', ['id' => $complaint->id]) }}"><button type="button" class="bg-gray-500 text-white p-2 rounded text-sm w-auto mr-2">
                            Cancel
                        </button></a>
                        <button type="submit" class="bg-yellow-500 text-white p-2 rounded text-sm w-auto">
                            Save
                        </button>
                    </div>
                </div>
                </div>

            </x-form>
        </div>
    </x-slot>
</x-app-layout>


