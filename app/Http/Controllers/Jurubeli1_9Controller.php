<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jurubeli1_9Controller extends Controller
{
    // Halaman utama daftar dokumen
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Juru Beli 9')->get();
        return view('Jurubeli1_9.index', compact('dokumen'));
    }

    /* Detail dokumen untuk halaman penuh (tidak dipakai di popup, tapi tetap disimpan jika perlu)
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('Jurubeli1.show', compact('dokumen'));
    }*/

    // ✅ Endpoint tambahan untuk AJAX (popup modal)
    public function showJson($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json($dokumen);
    }

    // Menyetujui dokumen
public function setujui(Request $request, $id)
{
    $request->validate([
        'next_verifikator' => 'required|string|in:Kepala_Biro_1,Kepala_Biro_2,Kepala_Biro_3',
    ], [
        'next_verifikator.required' => 'Pilih Kepala Biro selanjutnya.',
    ]);

    $dokumen = Dokumen::findOrFail($id);
    $tanggalMasuk = $dokumen->updated_at;

    // Simpan status berdasarkan pilihan user
    $next = $request->input('next_verifikator');
    $dokumen->status_verifikasi = "Menunggu " . str_replace('_', ' ', $next);
    $dokumen->save();

    // Ambil nama jurubeli aktif
    $namaJurubeli = DB::table('users')
        ->where('role', 'Juru_Beli_9')
        ->value('name'); 

    // Simpan ke histori
    DB::table('histori_verifikasi')->insert([
        'dokumen_id' => $id,
        'posisi' => 'Juru Beli 9',
        'jurubeli' => $namaJurubeli,
        'tanggal_masuk' => $tanggalMasuk,
        'tanggal_keluar' => now(),
        'catatan' => "Disetujui oleh Juru Beli 9 dan diteruskan ke " . str_replace('_', ' ', $next) . " ",
    ]);

    return redirect()->route('Jurubeli1_9.index')
        ->with('success', "Dokumen disetujui dan diteruskan ke " . str_replace('_', ' ', $next) . " ");
}


    // Menolak dokumen
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ], [
            'keterangan.required' => 'Kolom alasan penolakan wajib diisi.',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        $dokumen->status_verifikasi = 'Ditolak Jurubeli 9';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        $namaJurubeli = DB::table('users')
            ->where('role', 'Juru_Beli_9')
            ->value('name');

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Juru Beli 9',
            'jurubeli' => $namaJurubeli,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('Jurubeli1_9.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }
}
