<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:1000',
        ];
    }
}
