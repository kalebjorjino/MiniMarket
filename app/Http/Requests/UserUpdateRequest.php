<?php

namespace App\Http\Requests;

use App\Rules\alpha_spaces;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'e_first_name' => ['required', 'string', 'max:255', new alpha_spaces],
            'e_last_name' => ['required', 'string', 'max:255', new alpha_spaces],
            'e_phone_number' => ['required', 'numeric', 'digits:11'],
            'e_address' => ['required', 'string',  'max:255'],
            'e_email' => ['required', 'email', 'string', 'max:255','unique:users,email,'.$this->user],
            'e_pass' => ['nullable', 'string', 'confirmed'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->e_pass == null) {
            $this->request->remove('e_pass');
        }
    }
    
    public function attributes(): array
    {
        return [
            'e_first_name' => 'first name',
            'e_last_name' => 'last name',
            'e_phone_number' => 'phone number',
            'e_address' => 'address',
            'e_email' => 'email address',
            'e_pass' => 'password',
        ];
    }
}
