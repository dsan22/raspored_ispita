<?php
namespace App\Http\Requests\Traits;

use App\Models\Exam;
use App\Models\ExaminationPeriod;

trait ExamValidator {

    protected function dateIsOutsideExaminationPeriod($date, $examinationPeriod)
    {
        $startDate = new \DateTime($examinationPeriod->start_date);
        $endDate = new \DateTime($examinationPeriod->end_date);
        $date=new \DateTime($date);
        return ($date < $startDate || $date > $endDate) ;
    }


    protected function durationIsLongerThanFourHours($duration)
    {
        [$hours, $minutes] = explode(':', $duration);
        $totalMinutes = ($hours * 60) + $minutes;

        return ($totalMinutes > 240);
          
    }

   
    protected function subjectIsScheduledForExaminationPeriod($subject, $examinationPeriod)
    {
        return (Exam::where('subject_id', $subject)
                ->where('examination_period_id', $examinationPeriod)
                ->exists()) ;
    }

   
    protected function examIsOverlapingInClassroom($date,$time,$duration,$classroomId, $skipExamId=null)
    {
        $conflicts = Exam::where('classroom_id', $classroomId)
            ->where("date",$date)
            ->where(function($query) use ($time, $duration) {
                $query->where(function($query) use ($time, $duration) {
                    $query->whereRaw('TIME_TO_SEC(time) < TIME_TO_SEC(?)+TIME_TO_SEC(?)', [$time,$duration])
                        ->whereRaw('TIME_TO_SEC(time) + TIME_TO_SEC(duration) > TIME_TO_SEC(?)', [$time]);
                });
            })
            ->get();

        if ($skipExamId) {
            $conflicts = $conflicts->filter(function($conflict) use ($skipExamId) {
                return $conflict->id !==  $skipExamId;
            });
        }
        return !$conflicts->isEmpty();
    }


}