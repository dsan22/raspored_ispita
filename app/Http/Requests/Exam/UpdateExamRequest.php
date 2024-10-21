<?php

namespace App\Http\Requests\Exam;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\Traits\ExamValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends AdminRequest
{
    use ExamValidator;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'date' => ['required', 'date', function ($attribute, $value, $fail) {
                $exam=   $this->route('exam');
                $examinationPeriod = $exam->examinationPeriod;
                if ($this->dateIsOutsideExaminationPeriod($value,$examinationPeriod)) {
                    $fail('The date must be within the examination period.');
                }
            }],
            'time' => 'required',
            'duration' => ['required', function ($attribute, $value, $fail) {
                if ($this->durationIsLongerThanFourHours($value)) { 
                    $fail('The duration must be less than 4 hours.');
                }
            }],
            'classroom_id' => ['required', 'exists:classrooms,id', function ($attribute, $value, $fail) {
                $date = $this->input('date');
                $time = $this->input('time');
                $duration = $this->input('duration');
                $exam=  $this->route('exam');
            
                if ($this->examIsOverlapingInClassroom($date,$time,$duration,$value,$exam->id)) {
                    $fail("The exam overlaps with an existing exam  on the same date.");
                }
            }],
        ];
    }
}
