@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <main class="container mx-auto p-4">
        <h2 class="text-3xl font-semibold mb-4 text-white">Edit Complaint</h2>

        <form method="post" action="{{ route('complaints.update', $complaint->id) }}" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-600">Date:</label>
                <input type="date" name="date" id="date" class="form-input w-full" value="{{ $complaint->date }}" required>
            </div>

            <div class="mb-4">
                <label for="summary" class="block text-sm font-medium text-gray-600">Summary:</label>
                <input type="text" name="summary" id="summary" class="form-input w-full" value="{{ $complaint->summary }}" required>
            </div>

            <div class="mb-4">
                <label for="full_text" class="block text-sm font-medium text-gray-600">Full Complaint:</label>
                <textarea name="full_text" id="full_text" class="form-textarea w-full" rows="4" required>{{ $complaint->full_text }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status:</label>
                <select name="status" id="status" class="form-select w-full" required>
                    <option value="not_acknowledged" {{ $complaint->status === 'not_acknowledged' ? 'selected' : '' }}>Not Acknowledged</option>
                    <option value="pending_investigation" {{ $complaint->status === 'pending_investigation' ? 'selected' : '' }}>Pending Investigation</option>
                    <option value="under_investigation" {{ $complaint->status === 'under_investigation' ? 'selected' : '' }}>Under Investigation</option>
                    <option value="resolved_justified" {{ $complaint->status === 'resolved_justified' ? 'selected' : '' }}>Resolved Justified</option>
                    <option value="resolved_unjustified" {{ $complaint->status === 'resolved_unjustified' ? 'selected' : '' }}>Resolved Unjustified</option>
                </select>
            </div>


            <div class="mb-4">
                <label for="complaint_type" class="block text-sm font-medium text-gray-600">Complaint Type:</label>
                <select name="complaint_type" id="complaint_type" class="form-select w-full" required>
                    <option value="complaint" {{ $complaint->complaint_type === 'complaint' ? 'selected' : '' }}>Complaint</option>
                    <option value="dissatisfaction" {{ $complaint->complaint_type === 'dissatisfaction' ? 'selected' : '' }}>Dissatisfaction</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary text-indigo-600 hover:underline">Update Complaint</button>
        </form>
    </main>
</div>
@endsection
