@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <main class="container mx-auto p-4">
        <h2 class="text-3xl font-semibold mb-4 text-white">Complaint Details</h2>

        <div class="max-w-md mx-auto">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Date:</label>
                <p class="form-input">{{ $complaint->date }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Summary:</label>
                <p class="form-input">{{ $complaint->summary }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Full Complaint:</label>
                <p class="form-textarea">{{ $complaint->full_text }}</p>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status:</label>
                <p class="form-input">{{ ucwords(str_replace('_', ' ', $complaint->status)) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Complaint Type:</label>
                <p class="form-input">{{ ucwords($complaint->complaint_type) }}</p>
            </div>
        </div>
        <div class="container mx-auto p-4 mt-4">
            <a href="{{ route('complaints.edit', ['complaint' => $complaint->id]) }}" class="btn btn-primary text-indigo-600 hover:underline">Edit Complaint</a>
        </div>
        <div class="container mx-auto p-4 mt-4">
            <a href="{{ route('complaints.notes.create', ['complaint' => $complaint->id]) }}" class="btn btn-primary text-indigo-600 hover:underline">Add Note</a>
        </div>

    </main>

    <div class="container mx-auto p-4 mt-4">
        <h2 class="text-3xl font-semibold mb-4 text-white">Notes</h2>
        @if ($complaint->notes->isEmpty())
            <p class="text-gray-600">No notes available for this complaint.</p>
        @else
            <ul class="border border-gray-200 rounded-lg p-4">
                @foreach ($complaint->notes as $note)
                <li class="mb-2 text-white">
                    {{ $note->content }} 
                    (Added by: {{ optional($note->user)->name ?? 'Unknown' }}, {{ $note->created_at->format('M d, Y') }})
                </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection
