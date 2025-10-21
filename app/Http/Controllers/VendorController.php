<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class VendorController extends Controller
{
    // 🧩 Tampilkan form input dokumen
    public function create()
    {
        $jurubelis = User::whereIn('role', [
            'Juru_Beli_1','Juru_Beli_2', 'Juru_Beli_3', 'Juru_Beli_4', 
            'Juru_Beli_5', 'Juru_Beli_6','Juru_Beli_7', 'Juru_Beli_8',
            'Juru_Beli_9', 'Juru_Beli_10', 'Juru_Beli_11', 'Juru_Beli_12',
            'Juru_Beli_13', 'Juru_Beli_14'
        ])->pluck('name', 'role');

        return view('input-dokumen', compact('jurubelis'));
    }


    // 🧩 Proses penyimpanan dokumen baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required',
            'pekerjaan'     => 'required',
            'tujuan'        => 'required', 
            'file_pdf'      => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan file PDF
        $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $request->file('file_pdf')->getClientOriginalName());
        $path = $request->file('file_pdf')->storeAs('dokumen_pdf', $fileName, 'public');

        $userTujuan = User::where('role', $request->tujuan)->first();

        if (!$userTujuan) {
            return back()->with('error', 'User tujuan tidak ditemukan di database.');
        }

        $roleTujuan = $userTujuan->role;
        $namaTujuan = $userTujuan->name;

        // Buat status verifikasi dinamis
        $status = "Menunggu " . ucfirst(str_replace('_', ' ', $roleTujuan));

        // Simpan ke tabel dokumen
        DB::table('dokumen')->insert([
            'nomor_dokumen'      => $request->nomor_dokumen,
            'tanggal_dokumen'    => now()->toDateString(),
            'pekerjaan'          => $request->pekerjaan,
            'tujuan'             => $namaTujuan, 
            'file_pdf'           => $path,
            'status_verifikasi'  => $status, 
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return back()->with('success', "Dokumen berhasil disimpan dan menunggu verifikasi dari {$namaTujuan}.");
    }


    public function showDashboard()
    {
        return view('dashboarduser');
    }

    // 🧩 Fitur pencarian dokumen
    public function search(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required',
        ]);

        $nomor = $request->input('nomor_dokumen');

        $dokumen = DB::table('dokumen')
            ->where('nomor_dokumen', $nomor)
            ->first();

        $histori = [];

        if ($dokumen) {
            $histori = DB::table('histori_verifikasi')
                ->where('dokumen_id', $dokumen->id)
                ->orderBy('tanggal_masuk', 'asc')
                ->get();
        }

        return view('dashboarduser', compact('dokumen', 'histori'));
    }

    // 🧩 Daftar semua dokumen
    public function index()
    {
        $dokumen = DB::table('dokumen')->get();
        return view('index', compact('dokumen'));
    }

    // 🧩 Tampilkan file PDF
    public function showFile($id)
    {
        $dokumen = DB::table('dokumen')->where('id', $id)->first();

        if (!$dokumen || !$dokumen->file_pdf) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = storage_path('app/public/' . $dokumen->file_pdf);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan di server.');
        }

        return response()->file($path);
    }
}
