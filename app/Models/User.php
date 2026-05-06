<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'login_code',
        'birthday',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* --- BỔ SUNG CÁC MỐI QUAN HỆ --- */

    /**
     * Một User có thể viết nhiều bài bài viết (News/Posts)
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Một User có thể có nhiều vai trò (Admin, Editor, v.v.)
     */
    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}

    /**
     * Hàm hỗ trợ kiểm tra xem user có quyền nhất định không
     * Ví dụ dùng trong Blade: @if(Auth::user()->hasRole('admin'))
     */
    public function hasRole($roleName): bool
    {
        return $this->roles->contains('name', $roleName);
    }
    // lơp học mà sinh viên đang theo học
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_student', 'student_id', 'class_id');
    }
    public function courses()
    {
        return $this->belongsToMany(
            \App\Models\Course::class,
            'teacher_course',
            'teacher_id',
            'course_id'
        );
    }

    // Các khóa học mà sinh viên đang theo học
    public function studentCourses()
    {
        return $this->belongsToMany(
            \App\Models\Course::class,
            'course_student',
            'student_id',
            'course_id'
        )->withTimestamps();
    }
}
