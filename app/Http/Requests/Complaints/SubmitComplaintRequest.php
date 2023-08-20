<?php

namespace App\Http\Requests\Complaints;

use App\Http\Controllers\Complaints;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubmitComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @var App\Models\User $user
     * @return bool
     */
    public function authorize()
    {
        // retrieve the current user to ensure they are allowed to submit complaints
        $user = Auth::user();

        return $user->getCanCreateComplaint();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // ensure the summary and description are present
            'summary' => ['required', 'string'],
            'fulldescription' => ['required', 'string'],
            'category' => ['required', 'numeric', 'min:' . Complaints::COMPLAINT_CATEGORY_COMPLAINT, 'max:' . Complaints::COMPLAINT_CATEGORY_DISSATISFACTION]
        ];
    }
}
