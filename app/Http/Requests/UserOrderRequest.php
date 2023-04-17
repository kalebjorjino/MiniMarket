<?php

namespace App\Http\Requests;

use App\Rules\alpha_spaces;
use Illuminate\Foundation\Http\FormRequest;

class UserOrderRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255', new alpha_spaces],
            'last_name' => ['required', 'string', 'max:255', new alpha_spaces],
            'phone_number' => ['required', 'numeric', 'digits:11'],
            'address' => ['required', 'string',  'max:255'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'courier' => ['required'],
        ];
    }
}
