<?php

namespace App\Http\Requests\Exam;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\Traits\ExamValidator;
use App\Models\Exam;
use App\Models\ExaminationPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreExamRequest extends AdminRequest
{
    use ExamValidator;
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'date' => ['required', 'date', function ($attribute, $value, $fail) {
                $examinationPeriod = ExaminationPeriod::find($this->input('examination_period_id'));
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
            'examination_period_id' => 'required|exists:examination_periods,id',
            'subject_id' => ['required', 'exists:subjects,id', function ($attribute, $value, $fail) {
                $examinationPeriodId = $this->input('examination_period_id');
                if ($this->subjectIsScheduledForExaminationPeriod($value,$examinationPeriodId)) {
                    $fail('This subject has already been scheduled for this examination period.');
                }
            }],
            'classroom_id' => ['required', 'exists:classrooms,id', function ($attribute, $value, $fail) {
                $date = $this->input('date');
                $time = $this->input('time');
                $duration = $this->input('duration');
            
                if ($this->examIsOverlapingInClassroom($date,$time,$duration,$value)) {
                    $fail("The exam overlaps with an existing exam  on the same date.");
                }
            }],
        ];
    }
}
