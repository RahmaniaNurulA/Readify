<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string|max:100',
            'email'           => 'required|email|unique:pengguna,email',
            'password'        => 'required|min:8|confirmed',
            'nohp'            => 'required|string|max:15',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'agama'           => 'required|string|max:20',
        ], [
            'nama.required'          => 'Nama lengkap wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.unique'           => 'Email sudah terdaftar.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
            'nohp.required'          => 'Nomor HP wajib diisi.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required'         => 'Agama wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Simpan ke database dengan transaksi
        DB::beginTransaction();
        try {
            // 1. Simpan ke tabel pengguna
            $pengguna = Pengguna::create([
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'role'          => 'member',
                'tanggal_daftar'=> now()->toDateString(),
            ]);

            // 2. Simpan ke tabel member (id_user FK dari pengguna)
            Member::create([
                'id_user'       => $pengguna->id_user,
                'nama'          => $request->nama,
                'nohp'          => $request->nohp,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama'         => $request->agama,
            ]);

            DB::commit();

            return redirect()->route('login')
                ->with('success', 'Akun berhasil dibuat! Silakan login.');

        } catch (\Exception $e) {
    DB::rollBack();
    return redirect()->back()
        ->with('error', 'Error: ' . $e->getMessage()) // ← tambah pesan error asli
        ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}