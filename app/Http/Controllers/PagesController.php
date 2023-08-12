<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard(UserChart $chart)
    {
        $user_count = User::where('role', 'user')->get()->count();
        $all_course = Course::all()->count();
        $course = Course::all();
        $activeCourse = $course->where('is_active', '=', 1)->count();
        $inActiveCourse = $course->where('role', '=', 0)->count();

        if (Auth::user()->role == 'user') {
            return redirect()->route('course.index');
        }
        return view('dashboard', ['chart' => $chart->build()], compact('user_count', 'activeCourse', 'inActiveCourse'));
    }
}
