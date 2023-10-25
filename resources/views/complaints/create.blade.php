@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <main class="container mx-auto p-4">
        <h2 class="text-3xl font-semibold mb-4 text-white">Create a Complaint</h2>

        <form method="post" action="{{ route('complaints.store') }}" class="max-w-md mx-auto">
            @csrf

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-600">Date:</label>
                <input type="date" name="date" id="date" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label for="summary" class="block text-sm font-medium text-gray-600">Summary:</label>
                <input type="text" name="summary" id="summary" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label for="full_text" class="block text-sm font-medium text-gray-600">Full Complaint:</label>
                <textarea name="full_text" id="full_text" class="form-textarea w-full" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label for="complaint_type" class="block text-sm font-medium text-gray-600">Complaint Type:</label>
                <select name="complaint_type" id="complaint_type" class="form-select w-full" required>
                    <option value="complaint">Complaint</option>
                    <option value="dissatisfaction">Dissatisfaction</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Complaint</button>
        </form>
    </main>
</div>
@endsection
