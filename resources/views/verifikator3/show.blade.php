<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - Verifikator 3</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0a1730] text-white min-h-screen">

    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md p-0 flex justify-between">
        <div class="container mx-auto flex justify-between items-center px-6 py-5">
            <div>
                <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" class="h-12 md:h-14">
            </div>
            <nav class="flex items-center space-x-6 text-white">
                <a href="{{ url('/') }}"
                    class="border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0a1730] transition text-sm">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <main class="p-6">
        <div class="bg-white text-gray-900 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Detail Dokumen</h2>

            <p><strong>Nomor Dokumen:</strong> {{ $dokumen->nomor_dokumen }}</p>
            <p><strong>Tanggal:</strong> {{ $dokumen->tanggal_dokumen }}</p>
            <p><strong>Perihal:</strong> {{ $dokumen->perihal }}</p>
            <p><strong>Tujuan:</strong> {{ $dokumen->tujuan }}</p>
            <p><strong>Status:</strong> {{ $dokumen->status_verifikasi ?? '-' }}</p>

            <button onclick="openPdfModal('{{ route('vendor.showFile', $dokumen->id) }}')" class="text-blue-500 ">
                📄 Lihat File PDF
            </button>

            <div id="pdfModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 relative">

                    <button onclick="closePdfModal()"
                        class="absolute top-2 right-1 text-gray-700 hover:text-red-600 text-2xl font-bold">&times;</button>

                    <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-lg" frameborder="0"></iframe>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <form action="{{ route('v3.setujui', $dokumen->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        ✅ Setujui
                    </button>
                </form>

                <form action="{{ route('v3.tolak', $dokumen->id) }}" method="POST" class="flex-1">
                    @csrf
                    <textarea name="keterangan" rows="2"
                        class="border text-sm w-full rounded p-2 mb-2 @error('keterangan') border-red-500 @enderror"
                        placeholder="Alasan penolakan">{{ old('keterangan') }}</textarea>

                    @error('keterangan')
                        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                        ❌ Tolak
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function openPdfModal(url) {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            viewer.src = url;
            modal.classList.remove('hidden');
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            viewer.src = "";
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>