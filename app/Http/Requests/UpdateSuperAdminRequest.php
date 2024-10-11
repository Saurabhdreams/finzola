<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuperAdminRequest extends FormRequest
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
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'nullable|email|regex:/^[\w\-\.\+]+@[a-zA-Z0-9\-]+\.[a-zA-Z]{2,3}$/|is_unique:users,email,'.$this->route('super_admin'),
            'contact' => 'required|is_unique:users,contact,'.$this->route('super_admin'),
            'password' => [
                'nullable',
                'same:password_confirmation',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/'
            ],
            'status' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
    }
}
