<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        $rules = Setting::$rules;
        $rules['company_phone'] = [
            'required',
            function($attribute, $value, $fail) {
                $countryPhone = $this->input('country_phone');
                $prefixCode = $this->input('prefix_code');
                preg_match('/\+?\d+/', $countryPhone, $matches);
                $numericCountryCode = isset($matches[0]) ? preg_replace('/\D/', '', $matches[0]) : '';
                $numericCountryCode = trim($numericCountryCode);
                $value = trim($value);
                if ($prefixCode !== $numericCountryCode) {
                    $fail('The company phone number must start with the selected country code.');
                }
            }
        ];



        return $rules;
    }
    public function messages(): array
    {
        return [
            'app_name.required_with' => 'The application name must be a string.',
            'app_name.max' => 'The application name may not exceed 191 characters.',
            'company_name.required_with' => 'The company name must be a string.',
            'company_name.max' => 'The company name may not exceed 191 characters.',
            'app_logo.required_with' => 'The app logo must be a file of type: jpg, jpeg, png.',
            'company_logo.mimes' => 'The company logo must be a file of type: jpg, jpeg, png.',
            'country.required_with' => 'The country is required when additional address is shown in the invoice.',
            'state.required_with' => 'The state is required when additional address is shown in the invoice.',
            'city.required_with' => 'The city is required when additional address is shown in the invoice.',
            'zipcode.required_with' => 'The zipcode is required when additional address is shown in the invoice.',
            'fax_no.required_with' => 'The fax number is required when additional address is shown in the invoice.',
        ];
    }

}
