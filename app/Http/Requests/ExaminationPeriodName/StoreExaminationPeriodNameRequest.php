<?php

namespace App\Http\Requests\ExaminationPeriodName;

use App\Http\Requests\AdminRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationPeriodNameRequest extends AdminRequest
{ 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
