<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "firstname" => "required|string|max:18",
            "lastname" => "required|string|max:35",
            'phone'  => "required|string|max:20",
            'email' => "required|email:rfc,dns|unique:App\Models\Student",
            'birthday' => "required|date|before:today",            
        ];
    }
}
