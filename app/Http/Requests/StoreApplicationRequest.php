<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreApplicationRequest extends FormRequest
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
            'slug' => 'required|regex:/^[a-z0-9\-]+$/|unique:applications',
            'name' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'models.*.name' => 'required',
            'models.*.url' => 'required|url',
            'logo' => File::image(['png', 'jpeg'])->max('5mb'),
            'logo_clear' => 'nullable|boolean',
        ];
    }
}
