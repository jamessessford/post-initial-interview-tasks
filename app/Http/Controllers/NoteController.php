<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Complaint;

class NoteController extends Controller
{
    public function store(Request $request, Complaint $complaint)
    {
        // Validate the request
        $request->validate([
            'content' => 'required',
        ]);

        // Create a new note
        $note = new Note([
            'complaint_id' => $complaint->id,
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        $note->save();

        return redirect()->route('complaints.show', ['complaint' => $complaint->id])
            ->with('success', 'Note added successfully.');
    }
}
