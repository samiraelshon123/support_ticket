<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png,webp',
           
        ];
    }
}
