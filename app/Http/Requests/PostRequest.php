<?php

namespace App\Http\Requests;

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
        $imageRules = ['required', 'image', 'mimes:png,jpg', 'min:20', 'max:1024'];

        if ($this->routeIs('post.update'))
        {
            $imageRules = ['nullable', 'image', 'mimes:png,jpg', 'min:100', 'max:1024'];
        }

        return [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => $imageRules,
        ];
    }
}
