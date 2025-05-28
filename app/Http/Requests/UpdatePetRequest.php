<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
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
        // return [
        //     'name'         => 'required|string|max:255',
        //     'category_id'  => 'required|exists:categories,id',
        //     'breed_id'     => 'required|exists:breeds,id',
        //     'birth_date'   => 'nullable|date',
        //     'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'description'  => 'nullable|string',
        //     'status'       => 'required|in:available,adopted',
        // ];
        return [
            'name'         => 'required|string|max:255',
            'category'     => 'nullable|string|max:255',
            'breed'        => 'nullable|string|max:255',
            'birth_date'   => 'nullable|date',
            // 'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'  => 'nullable|string',
            'status'       => 'required|in:available,adopted',
        ];
    }
}
