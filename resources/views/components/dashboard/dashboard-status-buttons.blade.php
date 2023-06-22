@if(Auth::user()->type == 'App\Models\Admin')
    @php
        $statuses = [
            'Not acknowledged' => 'Pending investigation',
            'Pending investigation' => 'Under investigation',
            'Under investigation' => ['Resolved & justified', 'Resolved & unjustified'],
        ];
    @endphp

    @if(isset($statuses[$complaint->status]))
        @foreach((array) $statuses[$complaint->status] as $status)
            <div class="bg-indigo-100 w-36 p-1 ml-7 text-center rounded-md hover:bg-slate-400">
                <form action="{{ route('complaints.update', ['status' => $status, 'id' => $complaint->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button>{{ $status }}</button>
                </form>
            </div>
        @endforeach
    @endif
@endif
