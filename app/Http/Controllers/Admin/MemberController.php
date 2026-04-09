<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nohp', 'like', '%' . $request->search . '%')
                  ->orWhere('tempat_lahir', 'like', '%' . $request->search . '%');
        }

        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $members = $query->paginate(10)->withQueryString();
        $totalMember = Member::count();
        $totalPria   = Member::where('jenis_kelamin', 'L')->count();
        $totalWanita = Member::where('jenis_kelamin', 'P')->count();

        return view('admin.anggota.index', compact(
            'members', 'totalMember', 'totalPria', 'totalWanita'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:40',
            'nohp'          => 'nullable|string|max:15',
            'tempat_lahir'  => 'nullable|string|max:30',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama'         => 'nullable|string|max:10',
        ]);

        Member::create($request->all());

        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required|string|max:40',
            'nohp'          => 'nullable|string|max:15',
            'tempat_lahir'  => 'nullable|string|max:30',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama'         => 'nullable|string|max:10',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Anggota berhasil dihapus.');
    }

    public function detailBuku($id)
{
    $buku = Buku::with('kategoris')->findOrFail($id);
    return view('member.detail-buku', compact('buku'));
}

public function pinjamBuku(Request $request, $id)
{
    $user = Auth::user();
    $buku = Buku::findOrFail($id);

    // Cek stok
    if ($buku->jumlah_buku <= 0) {
        return back()->with('error', 'Stok buku habis!');
    }

    // Cek apakah user sudah meminjam buku ini
    $sudahPinjam = Peminjaman::where('id_user', $user->id_user)
    ->where('id_buku', $id)
    ->where('status_peminjaman', 'aktif')
    ->exists();

Peminjaman::create([
    'id_user'              => $user->id_user,
    'id_buku'              => $id,
    'tanggal_pinjam'       => now()->toDateString(),
    'tanggal_batas_pinjam' => now()->addDays(7)->toDateString(),
    'status_peminjaman'    => 'aktif',
]);

    // Kurangi stok
    $buku->jumlah_buku -= 1;
    $buku->save();

    return redirect()->route('member.buku')->with('success', 'Buku berhasil dipinjam! Batas pengembalian ' . now()->addDays(7)->format('d M Y'));
}
    
}