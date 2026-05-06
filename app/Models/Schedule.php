<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'course_id',
        'stt',
        'date_on_class',
        'ca',
        'theory_hours',
        'practice_hours',
        'test_hours',
        'content'
    ];

    // Ép kiểu ngày tháng để Laravel tự động convert sang đối tượng Carbon
    protected $casts = [
        'date_on_class' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
