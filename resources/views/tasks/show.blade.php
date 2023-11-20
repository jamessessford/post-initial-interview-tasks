<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }} &gt; {{ $task->id }}:{{ $task->user->email }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <pre>{{ $task }}</pre>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($notes->isNotEmpty())
                    <ul class="ml-4 list-disc">
                        @foreach ($notes as $note)
                            <li class="mb-8">
                                ID: {{ $note->user_id }}
                                <ul class="ml-4 list-disc">
                                    <li>Message: {{ $note->body }}</li>
                                    <li>Created At: {{ $note->created_at }}</li>
                                    <li>Updated At: {{ $note->updated_at }}</li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
