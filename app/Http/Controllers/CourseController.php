<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // 課程列表頁面
    public function index()
    {
        // 如果你之後要用資料庫，可以改成 Course::all()
        $courses = [
            ['name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            ['name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        return view('courses.index', compact('courses'));
    }
}
