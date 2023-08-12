<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Qualifications;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_qualifications = Qualifications::all();
        $details = collect($list_qualifications)->map(function ($item) {
            $instructor = Instructor::find($item['instructor_id']);
            return [
                'id' => $item->id,
                'topic_id' => $item->topic_id,
                'instructor_exp_year' => $instructor->exp_year,
                'instructor_name' => $instructor->instructor_name,
            ];
        });
        return view('qualification.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_instructor = Instructor::all();

        return view('qualification.create', compact('list_instructor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'topic_id' => 'required|string',
            'instructor_id' => 'required|string'
        ], [
            'required' => ':attribute tidak boleh kosong',
        ]);
        $create = Qualifications::create($validate);
        if ($create) {
            return redirect(route('qualification.index'))->with('success', 'Berhasil menambahkan qualification baru');
        }
        return back()->with('error', 'Gagal menambahkan qualification baru, coba lagi dalam beberapa menit');
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
    public function edit(Qualifications $qualification)
    {
        $list_instructor = Instructor::all();

        return view('qualification.edit', compact('qualification', 'list_instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualifications $qualification)
    {
        $validate = $request->validate([
            'topic_id' => 'required|string',
            'instructor_id' => 'required|string'
        ], [
            'required' => ':attribute tidak boleh kosong',
        ]);
        $update = $qualification->update($validate);

        if ($update > 0) {
            return redirect(route('qualification.index'))->with('success', 'Berhasil mengubah data qualification');
        }
        return back()->with('error', 'Gagal mengubah data qualification, coba lagi dalam beberapa menit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualifications $qualification)
    {
        $delete = $qualification->delete();

        if ($delete > 0) {
            return redirect()->back()->with('success', 'Berhasil menghapus data qualification');
        }
        return back()->with('error', 'Gagal menghapus data qualification, coba lagi dalam beberapa menit');
    }
}
