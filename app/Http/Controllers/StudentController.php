<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.dashboard'); // Đảm bảo bạn đã có file resources/views/student/dashboard.blade.php
    }
}
