<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title'=>'required|string',
            'content'=>'required|string',
            'image'=>'required|file',
            'category_id'=>'required|integer|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title should be written',
            'title.string' => 'Title should be string',
            'content.required' => 'Content should be written',
            'content.string' => 'Content should be text format',
            'image.required' => 'Image is required',
            'image.file' => 'Image should be file',
            'category_id.required' => 'Category should be chosen',
            'category_id.exists' => 'Category should be in database',
        ];
    }
}
