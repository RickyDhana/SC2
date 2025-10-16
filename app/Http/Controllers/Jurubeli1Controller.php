<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jurubeli1Controller extends Controller
{
    // Halaman utama daftar dokumen
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Jurubeli 1')->get();
        return view('Jurubeli1.index', compact('dokumen'));
    }

    // Detail dokumen untuk halaman penuh (tidak dipakai di popup, tapi tetap disimpan jika perlu)
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('Jurubeli1.show', compact('dokumen'));
    }

    // ✅ Endpoint tambahan untuk AJAX (popup modal)
    public function showJson($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json($dokumen);
    }

    // Menyetujui dokumen
    public function setujui($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        $dokumen->status_verifikasi = 'Disetujui Jurubeli 1';
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Jurubeli 1',
            'jurubeli' => 'Nama Jurubeli 1',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => 'Dokumen telah disetujui oleh Jurubeli 1.',
        ]);

        return redirect()->route('j1.index')->with('success', 'Dokumen disetujui dan akan diproses lebih lanjut.');
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

        $dokumen->status_verifikasi = 'Ditolak Jurubeli 1';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Jurubeli 1',
            'jurubeli' => 'Nama Jurubeli 1',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('j1.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }

}
