<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - Verifikator 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0a1730] text-white min-h-screen">
    {{-- Header --}}
    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md p-4 flex justify-between items-center">
        <h1 class="text-lg font-bold">Verifikasi Dokumen</h1>
        <a href="{{ route('v1.index') }}" class="text-sm text-white hover:underline">← Kembali</a>
    </header>

    {{-- Konten Utama --}}
    <main class="p-6">
        <div class="bg-white text-gray-900 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Detail Dokumen</h2>

            <p><strong>Nomor Dokumen:</strong> {{ $dokumen->nomor_dokumen }}</p>
            <p><strong>Tanggal:</strong> {{ $dokumen->tanggal_dokumen }}</p>
            <p><strong>Perihal:</strong> {{ $dokumen->perihal }}</p>
            <p><strong>Tujuan:</strong> {{ $dokumen->tujuan }}</p>
            <p><strong>Status:</strong> {{ $dokumen->status_verifikasi ?? '-' }}</p>

            <a href="{{ route('vendor.showFile', $dokumen->id) }}"
                target="_blank"
                class="text-blue-500 underline">
                📄 Lihat File PDF
            </a>




            {{-- Form Aksi --}}
            <div class="mt-6 flex gap-4">
                {{-- Tombol Setujui --}}
                <form action="{{ route('v1.setujui', $dokumen->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        ✅ Setujui
                    </button>
                </form>

                {{-- Tombol Tolak --}}
                <form action="{{ route('v1.tolak', $dokumen->id) }}" method="POST" class="flex-1">
                    @csrf
                    <textarea name="keterangan" rows="2" class="border text-sm w-full rounded p-2 mb-2"
                        placeholder="Alasan penolakan (opsional)..."></textarea>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                        ❌ Tolak
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>