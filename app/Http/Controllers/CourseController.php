<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // 課程列表頁面
    public function index()
    {
        // 如果你之後要用資料庫，可以改成 Course::all()
        $courses = [
            ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        return view('courses.index', compact('courses'));
    }
    public function register($id)
    {
        // 之後用資料庫時，可以改成 $course = Course::findOrFail($id);
        $courses = [
            1 => ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            2 => ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        $course = $courses[$id] ?? null;

        if (!$course) {
            abort(404, '找不到該課程');
        }

        // ➜ 這裡之後可以加上「儲存報名紀錄」的邏輯
        // auth()->user()->registrations()->create(['course_id' => $course->id]);

        return redirect()->route('courses.success', ['id' => $course['id']]);
    }

    /**
     * 報名成功頁面
     */
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
        // 模擬已報名課程
        // 真實情況：用 auth()->user()->courses() 撈資料庫
        $registeredCourses = [
            ['id' => 1, 'name' => '羽球入門課程', 'description' => '從基礎技巧學起，適合初學者'],
            // ['id' => 2, 'name' => '籃球進階訓練', 'description' => '提高投籃與戰術能力'],
        ];

        return view('courses.my_courses', compact('registeredCourses'));
    }
}
