<?php

namespace App\Http\Requests\ExaminationPeriod;

use App\Http\Requests\AdminRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationPeriodRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => [
                'required',
                'date',
                'after:today',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'examination_period_name_id' => [
                "required",
                "exists:examination_period_names,id"]
        ];
    }
}
