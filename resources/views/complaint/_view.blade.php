@bind($model)
<x-form-input readonly name="title" label="Title" />
<x-form-textarea readonly name="description" label="Description"/>
<x-form-input readonly name="category" label="Category" />
<x-form-input readonly name="status" label="Status" />
<a href="{{ route('note.add', ['id' => $model->id]) }}"><button class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add Note
</button></a>
@foreach($model->notes as $note)
    @php
        $username = \App\Models\User::find($note->user_id)->name
    @endphp

    <x-form-textarea readonly name="note" label="Note: User {{$username}}" :bind="$note" />
@endforeach
@endbind
