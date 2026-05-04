<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. TẠO DỮ LIỆU BẢNG ROLES
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Quản trị viên'
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
            'display_name' => 'Giảng viên'
        ]);

        $studentRole = Role::create([
            'name' => 'student',
            'display_name' => 'Sinh viên HHT'
        ]);

        // 2. TẠO DỮ LIỆU BẢNG USERS
        // Tạo tài khoản Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Tạo tài khoản Giáo viên
        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Tạo tài khoản Sinh viên
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // 3. TẠO DỮ LIỆU BẢNG ROLE_USER (Gắn quyền)
        $admin->roles()->attach($adminRole->id);
        $teacher->roles()->attach($teacherRole->id);
        $student->roles()->attach($studentRole->id);
    }
}