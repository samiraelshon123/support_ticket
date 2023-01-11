<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'string',
            'email' => 'email',
           
            'type' => ''
        ];
    }
}
