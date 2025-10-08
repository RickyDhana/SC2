<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Verifikator2Controller extends Controller
{
    /**
     * Menampilkan daftar dokumen yang menunggu verifikasi oleh Verifikator 2.
     * Dokumen yang ditampilkan adalah yang berstatus 'Disetujui Verifikator 1'.
     */
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Disetujui Verifikator 1')->get();
        return view('verifikator2.index', compact('dokumen'));
    }

    /**
     * Menampilkan detail sebuah dokumen.
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('verifikator2.show', compact('dokumen'));
    }

    /**
     * Menyetujui dokumen dan mengubah statusnya untuk Verifikator 3.
     */
    public function setujui($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        $tanggalMasuk = $dokumen->updated_at;

        // 1. Update status dokumen untuk proses selanjutnya
        $dokumen->status_verifikasi = 'Disetujui Verifikator 2';
        $dokumen->save();

        // 2. Simpan histori verifikasi
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 2',
            'verifikator' => 'Nama Verifikator 2', // Ganti dengan data user yang login
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(), // Waktu saat ini
            'catatan' => 'Dokumen telah disetujui oleh Verifikator 2.',
        ]);

        return redirect()->route('v2.index')->with('success', 'Dokumen disetujui dan akan diproses lebih lanjut.');
    }

    /**
     * Menolak dokumen dan mengubah statusnya.
     */
    public function tolak(Request $request, $id)
    {
        $request->validate(['keterangan' => 'required|string|max:255']);

        $dokumen = Dokumen::findOrFail($id);

        $tanggalMasuk = $dokumen->updated_at;
        
        // 1. Update status dokumen
        $dokumen->status_verifikasi = 'Ditolak Verifikator 2';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        // 2. Simpan histori verifikasi
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 2',
            'verifikator' => 'Nama Verifikator 2', // Ganti dengan data user yang login
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('v2.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }
}
