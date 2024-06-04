<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [       
            "name" => "required|string",
            "type" => "required|string|valid_user_type",
            "UBS" => "required_if:type,Doctor|array",
            "UBS.*" => "int|exists:ubs,id"
        ];
    }

    public function messages()
    {
        return [
            "type.valid_user_type" => "O tipo de usuário é invalido"
        ];
    }
    
}

