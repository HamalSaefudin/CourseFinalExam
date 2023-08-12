<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_instructor = Instructor::all();
        return view('instructor.index', compact('list_instructor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'instructor_name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|in:P,L',
            'exp_year' => 'required|integer',
            'exp_desc' => 'required|string|max:255'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'age.required' => 'Umur tidak boleh kosong',
            'exp_year.required' => 'Tahun pengalaman tidak boleh kosong',
            'exp_desc.required' => 'Deskripsi pengalaman tidak boleh kosong',
            'max' => 'Maksimal :value karakter'
        ]);

        $create = Instructor::create($validate);

        if ($create) {
            return redirect(route('instructor.index'))->with('success', 'Berhasil menambahkan instructor baru');
        }
        return back()->with('error', 'Gagal menambahkan instructor baru, coba lagi dalam beberapa menit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        $validate = $request->validate([
            'instructor_name' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|in:P,L',
            'exp_year' => 'required|integer',
            'exp_desc' => 'required|string|max:255'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'age.required' => 'Umur tidak boleh kosong',
            'exp_year.required' => 'Tahun pengalaman tidak boleh kosong',
            'exp_desc.required' => 'Deskripsi pengalaman tidak boleh kosong',
            'max' => 'Maksimal :value karakter'
        ]);

        $update = $instructor->update($validate);

        if ($update > 0) {
            return redirect(route('instructor.index'))->with('success', 'Berhasil mengubah data instructor');
        }
        return back()->with('error', 'Gagal mengubah data instructor, coba lagi dalam beberapa menit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $delete = $instructor->delete();

        if ($delete > 0) {
            return redirect()->back()->with('success', 'Berhasil menghapus data instructor');
        }
        return back()->with('error', 'Gagal menghapus data instructor, coba lagi dalam beberapa menit');
    }
}
