<?php

namespace App\Http\Requests\Label;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabelRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'string',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ];
    }
}
