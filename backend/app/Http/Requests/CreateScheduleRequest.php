<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
{   
    public function rules(): array
    {
        return [
            "receptionist_id" => "required|int|valid_receptionist",
            "patient_id" => "required|int|valid_patient",
            "doctor_id" => "required|int|valid_doctor",
            "ubs_id" => "required|int|exists:ubs,id",
            "scheduled_time" => "required|string|after_or_equal:". date('Y-m-d H:i:s')
        ];
    }

    public function messages()
    {
        return [
            "receptionist_id.valid_receptionist" => "O id de recepsionista não é valido",
            "patient_id.valid_patient" => "O id de paciente não é valido",
            "doctor_id.valid_doctor" => "O id de doctor não é valido"
        ];
    }
}
