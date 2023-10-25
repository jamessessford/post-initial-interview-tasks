<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Note;
use App\Models\User;
use Illuminate\Validation\Rule;

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
            'status' => 'not_acknowledged',
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
        // Define the allowed status transitions
        $statusTransitions = [
            'not_acknowledged' => 'pending_investigation',
            'pending_investigation' => 'under_investigation',
            'under_investigation' => ['resolved_justified', 'resolved_unjustified'],
            'resolved_justified' => 'final',
            'resolved_unjustified' => 'final',
        ];

        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'summary' => 'required|max:255',
            'full_text' => 'required',
            'complaint_type' => 'required|in:complaint,dissatisfaction',
            'status' => ['required', Rule::in(array_keys($statusTransitions))],
        ]);

        // Ensure the new status follows the defined order
        if (!$this->isValidStatusTransition($complaint->status, $request->input('status'), $statusTransitions)) {
            return redirect()->route('complaints.show', ['complaint' => $complaint->id])
                ->with('error', 'Invalid status transition.');
        }

        // Update the complaint
        $complaint->update([
            'date' => $request->input('date'),
            'summary' => $request->input('summary'),
            'full_text' => $request->input('full_text'),
            'complaint_type' => $request->input('complaint_type'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('complaints.show', ['complaint' => $complaint->id])
            ->with('success', 'Complaint updated successfully.');
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
            'complaint_id' => $complaint->id,
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
        $complaints = Complaint::with('user')->get();

        return view('complaints.all', compact('complaints'));
    }

    private function isValidStatusTransition($currentStatus, $newStatus, $statusTransitions)
    {
        if (!array_key_exists($currentStatus, $statusTransitions)) {
            return false;
        }

        $allowedTransitions = $statusTransitions[$currentStatus];
        if (is_array($allowedTransitions)) {
            return in_array($newStatus, $allowedTransitions);
        } else {
            return $newStatus === $allowedTransitions;
        }
    }
}
