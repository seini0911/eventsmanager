<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BadRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends BadRequest
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
            'name' => 'required|string|min:3|max:255',
            'phone'=> 'required|string|min:8|max:20|unique:users',
            'email'=> 'required|email|string|string|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed',
        ];
    }
}
