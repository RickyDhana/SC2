<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function create()
    {
        return view('input-dokumen');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_dokumen' => 'required',
            'tanggal_dokumen' => 'required|date',
            'perihal' => 'required',
            'tujuan' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $request->file('file_pdf')->getClientOriginalName());
        $path = $request->file('file_pdf')->storeAs('dokumen_pdf', $fileName, 'public');

        DB::table('dokumen')->insert([
            'nomor_dokumen' => $request->nomor_dokumen,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'perihal' => $request->perihal,
            'tujuan' => $request->tujuan,
            'file_pdf' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Dokumen berhasil disimpan.');
    }

    public function showDashboard()
    {
        return view('dashboarduser');
    }

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

    public function index()
    {
        $dokumen = DB::table('dokumen')->get();
        return view('index', compact('dokumen'));
    }

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
