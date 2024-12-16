<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO auth policies
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
            'slug' => 'required|regex:/^[a-z0-9\-]+$/|unique:applications',
            'name' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'models.*.name' => 'required',
            'models.*.url' => 'required|url',
        ];
    }
}
