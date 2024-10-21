<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        "name",
        "department_id",
        "user_id"
    ];
    
   
    public function department()
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
