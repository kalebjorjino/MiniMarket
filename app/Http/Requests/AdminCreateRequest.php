<?php

namespace App\Http\Requests;

use App\Rules\alpha_spaces;
use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', new alpha_spaces],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
