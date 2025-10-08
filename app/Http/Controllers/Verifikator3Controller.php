<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class Verifikator1Controller extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::where('status_verifikasi', 'Menunggu Verifikator 3')->get();
        return view('verifikator3.index', compact('dokumen'));
    }

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('verifikator1.show', compact('dokumen'));
    }

    public function setujui($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status_verifikasi = 'Disetujui Verifikator 1';
        $dokumen->save();

        return redirect()->route('v1.index')->with('success', 'Dokumen disetujui dan dikirim ke Verifikator 2.');
    }

    public function tolak(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status_verifikasi = 'Ditolak Verifikator 1';
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        return redirect()->route('v1.index')->with('error', 'Dokumen ditolak dan dikembalikan ke vendor.');
    }
}
