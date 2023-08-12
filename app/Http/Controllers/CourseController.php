<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Qualifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            $list_qualifications = Qualifications::all();
            $instructor_qualifications = collect($list_qualifications)->map(function ($item) {
                $instructor = Instructor::find($item['instructor_id']);
                return [
                    'id' => $item->id,
                    'topic_id' => $item->topic_id,
                    'instructor_id' => $item->instructor_id,
                    'instructor_name' => $instructor->instructor_name,
                ];
            });
            $list_courses = Course::where('is_active', 1)->get();
            return view('course.list', compact('list_courses', 'instructor_qualifications', 'user'));
        }
        $list_courses = Course::all();
        return view('course.index', compact('list_courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'course_name' => 'required|string',
            'price' => 'required|integer',
            'is_certificate' => 'string',
            'is_active' => 'string',
            'days' => 'required|integer',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'days.required' => 'Hari tidak boleh kosong',
        ]);
        $validate['is_certificate'] = isset($validate['is_certificate']) && $validate['is_certificate'] == 'Y' ? 1 : 0;
        $validate['is_active'] = isset($validate['is_active']) && $validate['is_active'] == 'Y' ? 1 : 0;

        $create = Course::create($validate);

        if ($create) {
            return redirect(route('course.index'))->with('success', 'Berhasil menambahkan course baru');
        }
        return back()->with('error', 'Gagal menambahkan course baru, coba lagi dalam beberapa menit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validate = $request->validate([
            'course_name' => 'required|string',
            'price' => 'required|integer',
            'is_certificate' => 'string',
            'is_active' => 'string',
            'days' => 'required|integer',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'days.required' => 'Hari tidak boleh kosong',
        ]);
        $validate['is_certificate'] = isset($validate['is_certificate']) && $validate['is_certificate'] == 'Y' ? 1 : 0;
        $validate['is_active'] = isset($validate['is_active']) && $validate['is_active'] == 'Y' ? 1 : 0;

        $update = $course->update($validate);

        if ($update > 0) {
            return redirect(route('course.index'))->with('success', 'Berhasil mengubah data course');
        }
        return back()->with('error', 'Gagal mengubah data course, coba lagi dalam beberapa menit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $delete = $course->delete();

        if ($delete > 0) {
            return redirect()->back()->with('success', 'Berhasil menghapus data course');
        }
        return back()->with('error', 'Gagal menghapus data course, coba lagi dalam beberapa menit');
    }
}
