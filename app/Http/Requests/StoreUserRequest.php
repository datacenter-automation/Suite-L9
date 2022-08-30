<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
    return true;
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'email' => "string", 'username' => "string"])] public function rules(): array
    {
    return [
        'name' => 'required',
        'email' => 'required|email:rfc,dns|unique:users,email',
        'username' => 'required|unique:users,username',
    ];
}
}
