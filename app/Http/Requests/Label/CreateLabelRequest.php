<?php

namespace App\Http\Requests\Label;

use Illuminate\Foundation\Http\FormRequest;

class CreateLabelRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string|unique:labels',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ];
    }
}
