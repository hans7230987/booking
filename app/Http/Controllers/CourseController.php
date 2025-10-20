<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // 課程列表頁面
    public function index()
    {
        $courses = [
            ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        return view('courses.index', compact('courses'));
    }
    public function register($id)
    {
        $courses = [
            1 => ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            2 => ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        $course = $courses[$id] ?? null;

        if (!$course) {
            abort(404, '找不到該課程');
        }

        return redirect()->route('courses.success', ['id' => $course['id']]);
    }

    // 報名成功頁面
    public function success($id)
    {
        $courses = [
            1 => ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            2 => ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        $course = $courses[$id] ?? null;

        if (!$course) {
            abort(404, '找不到該課程');
        }

        return view('courses.success', compact('course'));
    }

    public function myCourses()
    {
        $registeredCourses = [
            ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            // ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        return view('courses.my_courses', compact('registeredCourses'));
    }
}
