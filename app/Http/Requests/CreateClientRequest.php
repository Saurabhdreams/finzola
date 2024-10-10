<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Stancl\Tenancy\Database\TenantScope;

class CreateClientRequest extends FormRequest
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
        $existUser = \App\Models\User::whereEmail(request()->email)->withoutGlobalScope(new TenantScope())->first();

        $rules = Client::$rules;
       
        $rules['postal_code'] = ['required', 'digits:6'];
        $rules['first_name'] = ['required', 'max:35'];
        $rules['last_name'] = ['required', 'max:35'];
        $rules['email'] = ['required', 'email'];
    
        return $rules;

    }
	 /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'postal_code.digits' => 'The postal code must be exactly 6 digits.',
            'first_name.max' => 'The first name may not be greater than 35 characters.',
            'last_name.max' => 'The last name may not be greater than 35 characters.',
            'email.email' => 'The email address must be a valid email format.',
        ];
    }
}
