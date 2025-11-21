<?php

namespace App\Http\Requests;

use App\FileRelationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Validation\Rule;

// Importa el Enum de FileType
use App\Enums\FileType;

class StoreNews extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file_id' => 'required|exists:files,file_id',
            'images' => 'array',
            'images.*' => 'exists:files,file_id',

            'videos' => 'array',
            'videos.*' => 'exists:files,file_id',
        ];

        // 
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Errores de validación',
            'errors' => $validator->errors(),
        ], 422));
    }
}
