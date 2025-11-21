<?php

namespace App\Http\Requests;

use App\FileRelationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateNews extends FormRequest
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
            "title"       => "sometimes|string|max:255",
            "description" => "sometimes|string|max:500",
            "file_id"     => "nullable|uuid|exists:files,file_id",

            // Arrays opcionales
            "images"      => "sometimes|array",
            "images.*"    => "uuid|exists:files,file_id",

            "videos"      => "sometimes|array",
            "videos.*"    => "uuid|exists:files,file_id",
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
