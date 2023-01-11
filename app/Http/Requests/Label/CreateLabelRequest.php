<?php

namespace App\Http\Requests\Label;

use Illuminate\Foundation\Http\FormRequest;

class CreateLabelRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ];
    }
}
