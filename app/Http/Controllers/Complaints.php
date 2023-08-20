<?php

namespace App\Http\Controllers;

use App\Http\Requests\Complaints\AddNoteRequest;
use App\Http\Requests\Complaints\SubmitComplaintRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Complaints extends Controller
{
    public const COMPLAINT_CATEGORY_COMPLAINT = 0;
    public const COMPLAINT_CATEGORY_DISSATISFACTION = 1;

    public const COMPLAINT_STATUS_NOTACKNOWLEDGED = 0;
    public const COMPLAINT_STATUS_PENDINGINVESTIGATION = 1;
    public const COMPLAINT_STATUS_UNDERINVESTIGATION = 2;
    public const COMPLAINT_STATUS_RESOLVEDANDJUSTIFIED = 3;
    public const COMPLAINT_STATUS_RESOLVEDANDUNJUSTIFIED = 4;

    /**
     * Handle a submit complaint request
     */
    public function submitComplaint(SubmitComplaintRequest $request)
    {
        // retrieve the user ID
        $userId = Auth::id();
        $userName = Auth::user()->name;

        // retrieve the submitted details from the request
        $complaintCategory = $request->input('category');
        $complaintSummary = $request->input('summary');
        $complaintFullDescription = $request->input('fulldescription');

        // insert the complaint
        DB::table('complaints')->insert(
            [
                'category' => $complaintCategory,
                'status' => Self::COMPLAINT_STATUS_NOTACKNOWLEDGED,
                'dateofcomplaint' => now(),
                'summary' => $complaintSummary,
                'fullbody' => $complaintFullDescription,
                'notes' => 'Logged By: ' . $userName,
                'user' => $userId
            ]
        );

        return view('complaints.logcomplaintsuccess');
    }

    /**
     * retrieve complaint list
     */ 
    public function retreiveComplaintList()
    {
        // retrieve the summary and id from the table to return for the list
        $complaintsQueryResult = DB::table('complaints')->select('id', 'summary')->get();
        
        return $complaintsQueryResult;
    }

    /**
     * retrieve full details on a complaint 
     */
    public function retrieveComplaintDetails(Request $request)
    {
        // get the complain id from the request
        $complaintID = $request->input('id');

        // retrieve a single entry with this id
        $complaintQueryResult = DB::table('complaints')->where('id', $complaintID)->first();

        return $complaintQueryResult;
    }

    /**
     *  add note to a specified complaint
     */
    public function addNoteToComplaint(AddNoteRequest $request)
    {
        // retreieve the details from the request
        $complaintID = $request->input('id');
        $complaintNote = $request->input('note');

        // note that we do not need to check the users permissions as it has already been checked on the request authorisation
        DB::table('complaints')->where('id', $complaintID)->update(['notes' => $complaintNote]);
    }
}
