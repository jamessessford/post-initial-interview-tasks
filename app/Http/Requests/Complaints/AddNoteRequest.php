<?php

namespace App\Http\Requests\Complaints;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @var App\Models\User $user 
     * @return bool
     */
    public function authorize()
    {
         // retrieve the current user to ensure they are allowed to add notes
         $user = Auth::user();

         return $user->getCanUpdateNotes();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // ensure a complaint id has been provided and that a note to add is present
            'id' => ['required', 'numeric'],
            'note' => ['required', 'string']
        ];
    }
}
