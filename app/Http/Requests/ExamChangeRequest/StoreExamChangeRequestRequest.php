<?php

namespace App\Http\Requests\ExamChangeRequest;

use App\Http\Requests\Traits\ExamValidator;
use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamChangeRequestRequest extends FormRequest
{
    use ExamValidator;
    public function authorize(): bool
    {
        $exam = Exam::with('subject')->find($this->input('exam_id'));
        if (!$exam || !$exam->subject) {
            return false;
        }
        return $exam->subject->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return  [
            'exam_id' => 'required|exists:exams,id',
            'new_date' => ['required','date',function ($attribute, $value, $fail) {
                $exam=   Exam::find($this->input('exam_id'));
                $examinationPeriod = $exam->examinationPeriod;
                if ($this->dateIsOutsideExaminationPeriod($value,$examinationPeriod)) {
                    $fail('The date must be within the examination period.');
                }
            }],
            'new_time' => ['required',],
            'new_classroom' => ['required', 'exists:classrooms,id', function ($attribute, $value, $fail) {
                $date = $this->input('date');
                $time = $this->input('time');
                $duration = $this->input('duration');
                $exam=   Exam::find($this->input('exam_id'));
            
                if ($this->examIsOverlapingInClassroom($date,$time,$duration,$value,$exam->id)) {
                    $fail("The exam overlaps with an existing exam  on the same date.");
                }
            }]
        ];
    }
}
