<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use App\Rules\WithValidationRule;
use App\Rules\TagsValidationRule;
use App\Rules\LangValidationRule;
use App\Rules\CategoryValidationRule;
use App\Rules\PositiveIntegerRule;
use Illuminate\Http\Exceptions\HttpResponseException;

class MealRequest extends FormRequest
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
            'per_page' => [
                'nullable',
                'integer',
                new PositiveIntegerRule,
            ],
            'page' => [
                'nullable',
                'integer',
                new PositiveIntegerRule,
            ],
            'category' => [
                'nullable',
                'string',
                new CategoryValidationRule,
            ],
            'tags' => [
                'nullable',
                'string',
                new TagsValidationRule,
            ],
            'with' => [
                'nullable',
                'string',
                new WithValidationRule,
            ],
            'lang' => [
                'required',
                'string',
                new LangValidationRule,
            ],
            'diff_time' => [
                'nullable',
                'integer',
                new PositiveIntegerRule,
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
