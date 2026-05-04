<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'school_year',
    ];
    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student', 'class_id', 'student_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'class_course', 'class_id', 'course_id');
    }
}
