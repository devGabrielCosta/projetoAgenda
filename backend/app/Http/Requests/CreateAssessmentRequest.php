<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssessmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [        
            "schedule_id" => "required|int|exists:schedules,id",
            "comment" => "required|string"
        ];
    }
}
