<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|max:18|different:current_password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/|same:confirm_password',
            'confirm_password' => 'required|min:6|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
          'new_password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
          'new_password.different' => 'The new password cannot be the same as the current password.',
          'new_password.min' => 'The new password must be at least 6 characters long.',
        ];
    }
}
