<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }} &gt; {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('put')

                        <div class="mt-4">
                            <x-input-label for="type" :value="__('type')" />
                            <select name="type" id="type">
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('task_status_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="task_status_id" :value="__('task_status_id')" />
                            <select name="task_status_id" id="task_status_id">
                                @foreach ($task_statuses as $task_status)
                                    <option value="{{ $task_status->id }}">{{ $task_status->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('task_status_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="details" :value="__('details')" />
                            <x-text-input id="details" name="details" type="text" class="mt-1 block w-full" :value="old('details')" required autocomplete="details" />
                            <x-input-error class="mt-2" :messages="$errors->get('details')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="due_date" :value="__('due_date')" />
                            <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date')" required autocomplete="due_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="hours_required" :value="__('hours_required')" />
                            <x-text-input id="hours_required" name="hours_required" type="number" class="mt-1 block w-full" :value="old('hours_required', 1)" required autocomplete="hours_required" />
                            <x-input-error class="mt-2" :messages="$errors->get('hours_required')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="developer_id" :value="__('developer_id')" />
                            <select name="developer_id" id="developer_id">
                                @foreach ($developers as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->email }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('developer_id')" />
                        </div>

                        <div class="flex items-center mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
