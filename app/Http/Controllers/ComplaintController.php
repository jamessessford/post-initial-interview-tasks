<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintCreateRequest;
use App\Http\Requests\ComplaintUpdateRequest;
use App\Models\Complaint;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('complaint.index');
    }

    public function new()
    {
        return view('complaint.new', ['model' => new Complaint()]);
    }

    public function create(ComplaintCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $complaint = Complaint::create($request->validated());
            if (!empty(trim($request->validated(['note'])))) {
                Note::create(['user_id' => auth()->user()->id,
                    'note' => $request->validated('note'),
                    'noteable_type' => Complaint::class,
                    'noteable_id' => $complaint->id
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message', 'Could not save version information')->withInput();
        }
        DB::commit();
        return redirect(route('complaint.index'));
    }

    public function view($id)
    {
        $model = Complaint::findOrFail($id);
        $categories = Complaint::getCategories();
        $statuses = Complaint::getStatuses();
        return view('complaint.view', ['model' => $model]);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $model = Complaint::findOrFail($id);
        if ($user->cannot('edit', $model)) {
            abort(403);
        }
        return view('complaint.edit', ['model' => $model]);
    }

    public function update(ComplaintUpdateRequest $request)
    {
        $model = Complaint::findOrFail($request->get('id'));
        $user = Auth::user();
        if ($user->cannot('edit', $model)) {
            abort(403);
        }
        $model->update($request->validated());
        return redirect(route('complaint.index'));
    }
}
