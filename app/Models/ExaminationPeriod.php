<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminationPeriod extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'examination_period_name_id',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function examinationPeriodName()
    {
        return $this->belongsTo(ExaminationPeriodName::class)->withTrashed();
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

   
}
