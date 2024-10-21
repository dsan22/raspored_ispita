<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamChangeRequest extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "new_date",
        "new_time",
        "new_classroom",
        "change_approved",
        "exam_id"
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'new_classroom')->withTrashed();
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class)->withTrashed();
    }

}
