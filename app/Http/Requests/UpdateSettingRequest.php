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
            'company_phone.required' => 'Company phone required',
            'company_phone.invalid_phone_prefix' =>'The company phone number must start with the selected country code.',
        ];
    }
}
