<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'course_id',
        'student_id',
        'tx1',
        'tx2',
        'tx3',
        'tx4',
        'tx5',
        'tx6',
        'exam1',
        'exam2',
        'final1',
        'final2',
        'rank',
        'note',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}

