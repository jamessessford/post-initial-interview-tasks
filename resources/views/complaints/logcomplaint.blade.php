<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log New Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="/submit">
                @csrf
                <div>
                    <label for="summary">Summary:</label>
                    <input type="text" id="summary" name="summary" required>
                </div>
                <div>
                    <label for="fulldescription">Full Description:</label>
                    <input type="text" id="fulldescription" name="fulldescription" required>
                </div>
                {{-- this form is for complaints only and thus we always send back the category as 0--}}
                <input type="hidden" id='category' name='category' value=0>
                <x-primary-button type="submit">Submit</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
