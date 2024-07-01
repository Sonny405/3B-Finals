<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'student_id',   
        'subject_code',
        'name',
        'description',
        'instructor',
        'schedule',
        'grades',
        'average_grade',
        'remarks',
        'date_taken',
    ];
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
