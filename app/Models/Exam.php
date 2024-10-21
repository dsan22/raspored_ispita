<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "date",
        "time",
        "duration",
        "examination_period_id",
        "subject_id",
        "classroom_id"
    ];
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class)->withTrashed();
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class)->withTrashed();
    }

    public function examinationPeriod()
    {
        return $this->belongsTo(ExaminationPeriod::class);
    }
    public function examChangeRequests()
    {
        return $this->hasMany(ExamChangeRequest::class);
    }
    

}
