<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'priority' => 'array'
        ];
    }
}
