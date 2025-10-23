<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepaladepartemenController extends Controller
{
    // ✅ Menampilkan daftar dokumen yang menunggu Kepala Departemen
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Kepala Departemen')->get();
        return view('KepalaDepartemen.index', compact('dokumen'));
    }

    // ✅ Endpoint untuk popup modal / AJAX detail dokumen
    public function showJson($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json($dokumen);
    }

    // ✅ Menyetujui dokumen — otomatis juga oleh Kepala Divisi
    public function setujui(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        // 🔹 Update status langsung ke tahap setelah Kepala Divisi (misalnya "Menunggu Verifikator 1" atau "Selesai")
        $dokumen->status_verifikasi = "Menunggu Verifikator 1"; 
        $dokumen->save();

        // 🔹 Ambil nama Kepala Departemen & Kepala Divisi aktif
        $namaKepalaDepartemen = DB::table('users')
            ->where('role', 'Kepala_Departemen')
            ->value('name');

        $namaKepalaDivisi = DB::table('users')
            ->where('role', 'Kepala_Divisi')
            ->value('name');

        // 🔹 Simpan histori verifikasi Kepala Departemen
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Kepala Departemen',
            'jurubeli' => $namaKepalaDepartemen,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => "Disetujui oleh Kepala Departemen.",
        ]);

        // 🔹 Simpan histori verifikasi Kepala Divisi otomatis
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Kepala Divisi',
            'jurubeli' => $namaKepalaDivisi,
            'tanggal_masuk' => now(),
            'tanggal_keluar' => now(),
            'catatan' => "Disetujui otomatis oleh sistem setelah Kepala Departemen.",
        ]);

        return redirect()->route('KepalaDepartemen.index')
            ->with('success', 'Dokumen disetujui oleh Kepala Departemen dan otomatis disetujui oleh Kepala Divisi.');
    }

    // ✅ Menolak dokumen — dikembalikan ke Kepala Biro 1
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ], [
            'keterangan.required' => 'Kolom alasan penolakan wajib diisi.',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $tanggalMasuk = $dokumen->updated_at;

        // Update status & alasan
        $dokumen->status_verifikasi = 'Ditolak Kepala Departemen';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        // Ambil nama Kepala Departemen aktif
        $namaKepalaDepartemen = DB::table('users')
            ->where('role', 'Kepala_Departemen')
            ->value('name');

        // Simpan ke histori verifikasi
        DB::table('histori_verifikasi')->insert([
            'dokumen_id' => $id,
            'posisi' => 'Kepala Departemen',
            'jurubeli' => $namaKepalaDepartemen,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => now(),
            'catatan' => $request->keterangan,
        ]);

        return redirect()->route('KepalaDepartemen.index')
            ->with('error', 'Dokumen ditolak dan dikembalikan ke Kepala Biro 1.');
    }
}
