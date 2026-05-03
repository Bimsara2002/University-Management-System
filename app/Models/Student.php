<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'student_id',
        'year',
        'program',
        'phone',
        'address',
        'enrollment_status',
    ];
}