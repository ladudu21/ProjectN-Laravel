<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255|string',
            'category_id' => 'required',
            'content' => 'required',
            'thumb' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:5120',
            'published_at' => [
                'sometimes',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!is_null($value) && $value < now()) {
                        $fail("The {$attribute} is invalid.");
                    }
                },]
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id' => 'Category',
        ];
    }
}
