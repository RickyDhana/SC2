<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kepalabiro1_2Controller extends Controller
{
    // Menampilkan daftar dokumen yang menunggu Kepala Biro 2
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Kepala Biro 2')->get();
        return view('Kepalabiro1_2.index', compact('dokumen'));
    }

    // Endpoint untuk popup modal / AJAX
    public function showJson($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json($dokumen);
    }

    // Menyetujui dokumen — otomatis diteruskan ke Kepala Departemen
    public function setujui(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        // Update status langsung tanpa memilih verifikator
        $dokumen->status_verifikasi = "Menunggu Kepala Departemen";
        $dokumen->save();

        // Ambil nama Kepala Biro 2 aktif
        $namaKepalaBiro = DB::table('users')
            ->where('role', 'Kepala_Biro_2')
            ->value('name');

        // Simpan ke histori verifikasi
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Kepala Biro 2',
            'jurubeli' => $namaKepalaBiro,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => "Disetujui oleh Kepala Biro 2 dan diteruskan ke Kepala Departemen.",
        ]);

        return redirect()->route('Kepalabiro1_2.index')
            ->with('success', 'Dokumen disetujui dan diteruskan ke Kepala Departemen.');
    }

    // ✅ Menolak dokumen
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ], [
            'keterangan.required' => 'Kolom alasan penolakan wajib diisi.',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        // Update status & simpan alasan
        $dokumen->status_verifikasi = 'Ditolak Kepala Biro 2';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        // Ambil nama Kepala Biro 2 aktif
        $namaKepalaBiro = DB::table('users')
            ->where('role', 'Kepala_Biro_2')
            ->value('name');

        // Simpan ke histori
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Kepala Biro 2',
            'jurubeli' => $namaKepalaBiro,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('Kepalabiro1_2.index')
            ->with('error', 'Dokumen ditolak dan dikembalikan ke Juru Beli 2.');
    }
}