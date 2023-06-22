<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $complaints = $user->complaints;

        return view('dashboard', compact('complaints'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string'
        ]);

        // Create a new complaint and associate it with the authenticated user
        $complaint = $request->user()->complaints()->create($validatedData);
        
        return redirect()->route('dashboard')->with('success', 'Complaint created successfully!');
    }

    public function update(Request $request)
    {
        Complaint::updateOneComplaint($request->id, $request->status);

        return redirect()->route('dashboard')->with('success', '');
    }
}
