<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;

class KepalaDivisiController extends Controller
{
    // ✅ Menampilkan daftar dokumen yang menunggu Kepala Divisi
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Kepala Divisi')->get();
        return view('KepalaDivisi.index', compact('dokumen'));
    }

    // ✅ Endpoint untuk menampilkan detail dokumen (misal via modal atau halaman baru)
    public function showJson($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return response()->json($dokumen);
    }
}
