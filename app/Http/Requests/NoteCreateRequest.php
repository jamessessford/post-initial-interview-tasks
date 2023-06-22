<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //dd(request()->all());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'note' => 'required',
            'user_id' => 'required',
            'noteable_id' => 'required',
            'noteable_type' => 'required',
        ];
    }
}
