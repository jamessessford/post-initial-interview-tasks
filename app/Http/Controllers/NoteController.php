<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteCreateRequest;
use App\Models\Complaint;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function new($id)
    {
        $complaint = Complaint::findOrFail($id);
        $user = auth()->user();
        return view('note.new', ['complaint' => $complaint, 'user' => $user]);
    }

    public function create(NoteCreateRequest $request)
    {
        try {
            Note::create(['note' => $request->validated('note'), 'user_id' => $request->validated('user_id'), 'noteable_type' => Complaint::class, 'noteable_id' =>$request->validated('noteable_id')]);
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect(route('complaint.view', ['id' => $request->validated('noteable_id')]));
    }
}
