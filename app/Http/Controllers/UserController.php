<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $role = $request->role ?? 'user';

        $users = User::where('role', $role)->get();
        return view('users.index', compact('users', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'email.email' => 'email yang Anda masukkan tidak valid',
            'email.unique' => 'email yang Anda masukkan sudah terdaftar',
            'in' => ':attribute harus memiliki nilai :values',
        ]);
        $validate['password'] = Hash::make('Password123!');

        $create = User::create($validate);

        if ($create) {
            $role = $request->role;
            return redirect(route('users.index', ['role' => $role]))->with('success', "Berhasil menambahkan data {$request->role} baru");
        }
        return back()->with('error', 'Gagal menambahkan data user baru, coba lagi dalam beberapa menit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => ['nullable', Password::min(5)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'exclude'],
            'role' => 'required|in:admin,user'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'email.email' => 'email yang Anda masukkan tidak valid',
            'in' => ':attribute harus memiliki nilai :values',
            'password.*' => 'passowrd minimal memiliki 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol!'
        ]);

        if ($request->password != '') {
            $validate['password'] = Hash::make($request->password);
        }

        $update = $user->update($validate);

        if ($update > 0) {
            $role = $request->role;
            return redirect(route('users.index', ['role' => $role]))->with('success', 'Berhasil mengubah data user');
        }
        return back()->with('error', 'Gagal mengubah data user baru, coba lagi dalam beberapa menit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {

        $delete = $user->delete();

        if ($delete > 0) {
            return redirect()->back()->with('success', 'Berhasil menghapus data user');
        }
        return redirect()->back()->with('error', 'Gagal menghapus data user, coba lagi dalam beberapa menit');
    }
}
