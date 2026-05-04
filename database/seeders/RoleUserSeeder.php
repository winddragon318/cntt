<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tìm các đối tượng Role dựa trên cột 'name'
        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $studentRole = Role::where('name', 'student')->first();

        // 2. Gán quyền cho các User cụ thể (Ví dụ theo ID)
        
        // Gán User ID 1 làm Admin
        $admin = User::find(1);
        if ($admin && $adminRole) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        // Gán User ID 2 làm Teacher
        $teacher = User::find(2);
        if ($teacher && $teacherRole) {
            $teacher->roles()->syncWithoutDetaching([$teacherRole->id]);
        }

        // Gán User ID 3 làm Student
        $student = User::find(3);
        if ($student && $studentRole) {
            $student->roles()->syncWithoutDetaching([$studentRole->id]);
        }
    }
}