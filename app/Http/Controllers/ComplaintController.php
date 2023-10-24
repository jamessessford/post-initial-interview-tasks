<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Note;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'summary' => 'required|max:255',
            'full_text' => 'required',
            'complaint_type' => 'required|in:complaint,dissatisfaction',
        ]);

        // Create a new complaint
        $complaint = new Complaint([
            'date' => $request->input('date'),
            'user_id' => auth()->user()->id,
            'summary' => $request->input('summary'),
            'full_text' => $request->input('full_text'),
            'status' => 'not_acknowledged', // Updated status value
            'complaint_type' => $request->input('complaint_type'),
        ]);

        $complaint->save();

        return redirect()->route('complaints.show', ['complaint' => $complaint->id])
            ->with('success', 'Complaint created successfully.');
    }

    public function edit(Complaint $complaint)
    {
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'summary' => 'required|max:255',
            'full_text' => 'required',
            'complaint_type' => 'required|in:complaint,dissatisfaction',
            'status' => 'required|in:not_acknowledged,pending_investigation,under_investigation,resolved_&_justified,resolved_&_unjustified',
        ]);
    
        // Update the complaint if it's not "Under investigation"
        if ($complaint->status !== 'under_investigation') {
            $complaint->update([
                'date' => $request->input('date'),
                'summary' => $request->input('summary'),
                'full_text' => $request->input('full_text'),
                'complaint_type' => $request->input('complaint_type'),
                'status' => $request->input('status'), // Update the status field
            ]);
    
            return redirect()->route('complaints.show', ['complaint' => $complaint->id])
                ->with('success', 'Complaint updated successfully.');
        } else {
            return redirect()->route('complaints.show', ['complaint' => $complaint->id])
                ->with('error', 'Complaint cannot be updated as it is "Under investigation.');
        }
    }
    
    public function createNote(Complaint $complaint)
    {
        return view('notes.create', compact('complaint'));
    }

    public function addNote(Request $request, Complaint $complaint)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $note = new Note([
            'complaint_id' => $complaint->id, // Associate the note with the complaint
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        $note->save();

        return redirect()->route('complaints.show', ['complaint' => $complaint->id])
            ->with('success', 'Note added successfully.');
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('notes');
        return view('complaints.show', compact('complaint'));
    }

    public function allComplaints()
    {
        $complaints = Complaint::all();

        return view('complaints.all', compact('complaints'));
    }
}
