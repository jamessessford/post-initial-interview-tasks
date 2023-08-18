<?php

namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function upsert(Request $request, $id) {

        //validate user input
        $validated = $request->validate([
            'content' => 'string|required',
        ]);

        if($validated) {

            $note = Note::findOrNew($id);
         
            $note->user_id = $request->user_id;
    
            $note->complaint_id = $request->complaint_id;
    
            $note->content = $request->content;
    
            if($note->save()){
                
                return response()->json(['success'=>true, 'message'=>'Note posted Successfully!']);
                
            }else{
                return response()->json(['success'=>false , 'message'=>'Error.']);
            }
            
        }
    
    }

    public function destroy() {
        $note = Note::findOrFail($id);  
        if($note->delete()) {
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false , 'message'=>'Error.']);
        }   
    }
}
