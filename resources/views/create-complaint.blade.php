<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Complaint') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-center">
    <form action="{{ route('complaints.store') }}" class="flex flex-col items-center justify-center py-5 w-full" method="POST">
    <h2 class="font-semibold mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Complaint Form') }}
        </h2>   
    @csrf
        <div>
            <input type="text" name="title" id="title" placeholder="Title" class="input input-bordered input-warning w-96 rounded-md" />
        </div>
        <div>
            <textarea name="description" id="description" placeholder="Description" rows="7" class="input input-bordered input-warning w-96 mt-5 rounded-md" required></textarea>
        </div>
        <div>
            <select class="input input-bordered input-warning w-96 mt-5 rounded-md"  name="type" id="type">
                <option value="Complaint">Complaint</option>
                <option value="Dissatisfaction">Dissatisfaction</option>
            </select>
        </div>
        <button class="p-2 w-96 mt-5 rounded-md hover:bg-slate-200 bg-white" type="submit">Create Complaint</button>
    </form>
</div>

        </div>
    </div>
</x-app-layout>