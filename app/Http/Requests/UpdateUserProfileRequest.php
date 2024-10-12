<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileRequest extends FormRequest
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
        $id = Auth::id();

        return [
            'first_name' => 'required|max:35|alpha',
            'last_name' => 'required|max:35|alpha',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('@', $value);
                    if (count($parts) === 2 && preg_match('/\d/', $parts[1])) {
                        $fail('The :attribute should not contain numbers after the @ symbol.');
                    }
                    if (preg_match('/\.[a-zA-Z]{2,3}\.[a-zA-Z]{2,}$/', $parts[1])) {
                        $fail('The :attribute must not have multiple domain extensions.');
                    }
                }
            ],
                'contact' => [
                'required',
                'regex:/^\+?[1-9]\d{1,14}$/',
                'min:10',
                'max:15',
                ],

            'image' => 'mimes:jpeg,jpg,png',
        ];
    }
}
