<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Common\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:250',
            'slug' => 'required|string|unique:App\Models\Post,slug|max:250',
            'description' => 'required|string|max:2000',
            'body' => 'required|string|max:2000',
            'cover' => 'required|file',
            'category_id' => 'required|int|exists:App\Models\Category,id',
            'user_id' => 'int|exists:App\Models\User,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'slug' => str($this->title)->slug()->toString()
        ]);
    }
}
