<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Vì tên bảng trong SQL là 'courses' nên Laravel sẽ tự hiểu,
    // nhưng khai báo tường minh cho chắc chắn:
    protected $table = 'courses';

    protected $fillable = ['name', 'code'];

    // Quan hệ với Giáo viên (Nhiều - Nhiều)
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_course', 'course_id', 'teacher_id');
    }

    // Quan hệ với Lớp học (Nhiều - Nhiều)
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_course', 'course_id', 'class_id');
    }
}
