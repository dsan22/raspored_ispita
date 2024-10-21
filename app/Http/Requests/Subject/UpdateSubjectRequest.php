<?php

namespace App\Http\Requests\Subject;

use App\Http\Requests\AdminRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends AdminRequest
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
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
