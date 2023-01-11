<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'string',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ];
    }
}
