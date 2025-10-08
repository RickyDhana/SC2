<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Verifikator1Controller extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Verifikator 1')->get();
        return view('verifikator1.index', compact('dokumen'));
    }

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('verifikator1.show', compact('dokumen'));
    }

    public function setujui($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $tanggalMasuk = $dokumen->updated_at;

        $dokumen->status_verifikasi = 'Disetujui Verifikator 1';
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 1',
            'verifikator' => 'Nama Verifikator 1',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => 'Dokumen telah disetujui oleh Verifikator 1.',
        ]);

        return redirect()->route('v1.index')->with('success', 'Dokumen disetujui dan akan diproses lebih lanjut.');
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

        $dokumen->status_verifikasi = 'Ditolak Verifikator 1';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Verifikator 1',
            'verifikator' => 'Nama Verifikator 1',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('v1.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }
}

