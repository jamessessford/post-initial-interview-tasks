@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-semibold mb-4 text-white">All Complaints</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($complaints as $complaint)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $complaint->name }}</h3>
                        <p class="text-sm text-gray-600">Date: {{ $complaint->date }}</p>
                        <p class="text-sm text-gray-600">Logged by: {{ $complaint->user->name ?? 'Unknown' }}</p>
                        <p class="text-gray-700 mt-4">{{ $complaint->summary }}</p>
                        <p class="text-sm text-gray-600 mt-2">
                            Status:
                            @if ($complaint->status === 'resolved_justified')
                                Resolved & Justified
                            @elseif ($complaint->status === 'resolved_unjustified')
                                Resolved & Unjustified
                            @else
                                {{ ucwords(str_replace('_', ' ', $complaint->status)) }}
                            @endif
                        </p>
                    </div>
                    <div class="p-4 flex justify-end">
                        <a href="{{ route('complaints.show', ['complaint' => $complaint->id]) }}" class="text-indigo-600 hover:underline">View More</a>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>
@endsection
