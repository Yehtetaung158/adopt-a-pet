<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'category'     => 'nullable|string|max:255',
            'breed'        => 'nullable|string|max:255',
            'birth_date'   => 'nullable|date',
            // 'images'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'  => 'nullable|string',
            'status'       => 'required|in:available,adopted',
        ];
    }
}
