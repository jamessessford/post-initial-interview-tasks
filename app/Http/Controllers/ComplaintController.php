<?php

namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ComplaintController extends Controller
{
    public function index() {
        $complaints = Complaint::all();

        //would do my own paignation here with more time

        return response()->json(['success'=>true, 'complaints'=>$complaints]);
    }

    public function upsert(Request $request, $id) {

        //validate user input
        $validated = $request->validate([
            'summary' => 'string|required',
            'content' => 'string|required',
            'status' => 'status|required',
        ]);

        if($validated) {
            //get or create complaint using id
            $complaint = Complaint::findOrNew($id);

            //get user who makes complaint
            $user = find($user_id);

            //check if user can update or create complaint
            $response = Gate::allows('upsert-complaint', [$user, $comment]);
 
            //update or create
            if ($response->allowed()) {
        
                $complaint->user_id = $request->user_id;
        
                $complaint->summary = $request->summary;
        
                $complaint->content = $request->content;

                $complaint->category = $request->category;

                $complaint->status = $request->status;
        
                if($complaint->save()){
                    
                    //return true with complaint id if user needs to be redirected
                    return response()->json(['success'=>true, 'id'=>$complaint->id]);
                    
                }else{
                    return response()->json(['success'=>false , 'message'=>'Error.']);
                }
            } else {
                return response()->json(['success'=>false , 'message'=>'Unauthorized']);
            }
        }
    
    }

    //id == complaint id

    public function show($id) {
        //get notes associated with complaint through relationship
        $complaint = Complaint::with('notes')->findOrFail($id);

        return response()->json(['success'=>true, 'complaint'=>$complaint]);
    }

    public function destroy() {
        $complaint = Complaint::findOrFail($id);  
        if($complaint->delete()) {
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false , 'message'=>'Error.']);
        }   
    }
}
