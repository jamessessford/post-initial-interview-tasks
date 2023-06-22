<?php

namespace App\Http\Requests;

use App\Models\Complaint;
use App\Rules\StatusTransition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComplaintUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'title' => ['required',
            ],
            'description' => ['required'],
            'category' => [
                'required',
                Rule::in(array_keys(Complaint::getCategories())),
            ],
            'status' => [
                'required',
                Rule::in(array_keys(Complaint::getStatuses())),
                new StatusTransition
            ],
            'note' => ['sometimes']
        ];
    }
}
