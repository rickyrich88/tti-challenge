<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TaskPostRequest extends FormRequest
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
            'title' => ['required','string'],
            'description' => ['nullable','string'],
            'assigned_to' => ['nullable','string'],
            'due_date' => ['nullable','date'],
            'status' => [
                'required',
                'string',
                Rule::in(TaskStatusEnum::cases()),
            ],
        ];
    }
    
    /**
    * Get the error messages for the defined validation rules.*
    * @param Validator $validator
    * @return void
    *
    * @throws Illuminate\Http\Exceptions\HttpResponseException
    */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
