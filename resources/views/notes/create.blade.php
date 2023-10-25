@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-semibold mb-4 text-white">Add a Note</h2>

        <form method="post" action="{{ route('complaints.notes.store', ['complaint' => $complaint->id]) }}">
            @csrf

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-600">Note Content:</label>
                <textarea name="content" id="content" class="form-textarea w-full" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary text-indigo-600 hover:underline">Add Note</button>
        </form>
    </div>
@endsection
