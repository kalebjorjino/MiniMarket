<?php

namespace App\Http\Requests;

use App\Rules\alpha_spaces;
use Illuminate\Foundation\Http\FormRequest;

class AdminsUpdateRequest extends FormRequest
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
            'e_name' => ['required', 'string', 'max:255', new alpha_spaces],
            'e_email' => ['required', 'email', 'string', 'max:255', 'unique:admins,email,'.$this->admin],
            'e_pass' => ['nullable', 'string', 'confirmed'],
        ];
    }
    protected function prepareForValidation()
    {
        if ($this->e_pass == null) {
            $this->request->remove('e_pass');
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'e_name' => 'name',
            'e_email' => 'email address',
            'e_pass' => 'password',
        ];
    }
}
