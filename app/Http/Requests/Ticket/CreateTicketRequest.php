<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|string',
            'category' =>'required',
            'label' => 'required',
            'file' => 'nullable'
        ];
    }
}
