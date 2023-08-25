<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:1000',
        ];
    }
}
