<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';
    
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'sex',
        'address',
        'year',
        'course',
        'section',
    ];

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
