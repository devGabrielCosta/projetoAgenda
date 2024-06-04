<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "status" => "required|string|valid_status"
        ];
    }

    public function messages()
    {
        return [
            "status.valid_status" => "O tipo de status é invalido"
        ];
    }
}
