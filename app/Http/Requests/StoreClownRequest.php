<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClownRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required',
            'description.required' => 'The description is required',
            'rating.required' => 'The rating is required',
            'rating.numeric' => 'The rating must be a number',
            'rating.min' => 'The rating must be at least 1',
            'rating.max' => 'The rating may not be greater than 5',
            'status.required' => 'The status is required',
            'status.boolean' => 'The status must be a boolean',
        ];
    }
}
