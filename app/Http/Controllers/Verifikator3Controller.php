<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Verifikator3Controller extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Disetujui Verifikator 2')->get();
        return view('verifikator3.index', compact('dokumen'));
    }

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('verifikator3.show', compact('dokumen'));
    }

    public function setujui($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $tanggalMasuk = $dokumen->updated_at;

        $dokumen->status_verifikasi = 'Disetujui Verifikator 3';
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 3',
            'verifikator' => 'Nama Verifikator 3',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => 'Dokumen telah disetujui oleh Verifikator 3.',
        ]);

        return redirect()->route('v3.index')->with('success', 'Dokumen disetujui dan akan diproses lebih lanjut.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ], [
            'keterangan.required' => 'Kolom alasan penolakan wajib diisi.',
        ]);

        $dokumen = Dokumen::findOrFail($id);

        $tanggalMasuk = $dokumen->updated_at;

        $dokumen->status_verifikasi = 'Ditolak Verifikator 3';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 3',
            'verifikator' => 'Nama Verifikator 3',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('v3.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }
}
