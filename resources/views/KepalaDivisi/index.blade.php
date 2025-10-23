<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Divisi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0a1730] text-white min-h-screen">

    {{-- HEADER --}}
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

    {{-- MAIN CONTENT --}}
    <main class="p-6">
        <div class="max-w-screen-2xl mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-white">
                Daftar Dokumen Menunggu Pemeriksaan Kepala Divisi
            </h2>

            {{-- ✅ Notifikasi sukses --}}
            @if (session('success'))
                <div class="bg-green-600 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <table class="w-full text-black">
                    <thead class="bg-blue-700 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Nomor Dokumen</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Pekerjaan</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $d)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $d->nomor_dokumen }}</td>
                                <td class="px-4 py-2">{{ $d->tanggal_dokumen }}</td>
                                <td class="px-4 py-2">{{ $d->pekerjaan }}</td>
                                <td class="px-4 py-2">{{ $d->status_verifikasi }}</td>
                                <td class="px-4 py-2 text-center">
                                    <button onclick="openDetailModal({{ $d->id }})"
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                        Periksa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- 🔍 MODAL DETAIL --}}
    <div id="detailModal"
        class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 overflow-y-auto backdrop-blur-sm transition-opacity duration-300">
        <div
            class="bg-white text-gray-900 p-8 rounded-xl shadow-2xl w-11/12 max-w-2xl relative transform scale-95 opacity-0 transition-all duration-300">

            {{-- Tombol Tutup --}}
            <button onclick="closeDetailModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 text-3xl font-light transition">&times;</button>

            <h2 class="text-2xl font-extrabold mb-2 border-b pb-3 text-[#1c2e55]">Detail Dokumen</h2>

            <div id="detailContent" class="space-y-3 mb-6 pt-2">
                <div class="flex justify-between py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Nomor Dokumen:</p>
                    <p class="text-sm font-bold text-gray-900" id="nomor"></p>
                </div>
                <div class="flex justify-between py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Tanggal:</p>
                    <p class="text-sm font-bold text-gray-900" id="tanggal"></p>
                </div>
                <div class="flex justify-between py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Pekerjaan:</p>
                    <p class="text-sm font-bold text-gray-900" id="pekerjaan"></p>
                </div>
                <div class="flex justify-between py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Tujuan:</p>
                    <p class="text-sm font-bold text-gray-900" id="tujuan"></p>
                </div>
                <div class="flex justify-between py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Status:</p>
                    <p class="text-sm font-bold text-blue-600" id="status"></p>
                </div>

                <div class="text-center pt-4">
                    <button onclick="document.getElementById('pdfModal').classList.remove('hidden');" id="btnLihatPdf"
                        class="inline-flex items-center bg-blue-100 text-blue-700 font-bold px-4 py-2 rounded-full hover:bg-blue-200 transition text-sm shadow-inner">
                        Lihat File Dokumen
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 📄 MODAL PDF --}}
    <div id="pdfModal"
        class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 transition-opacity duration-300">
        <div id="pdfContainer" class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 relative">
            <button onclick="closePdfModal()"
                class="absolute -top-10 right-0 text-white hover:text-gray-200 text-3xl font-bold transition">&times;</button>
            <iframe id="pdfViewer" src="" class="w-full h-full rounded-lg" frameborder="0"></iframe>
        </div>
    </div>

    <script>
        // === MODAL DETAIL ===
        function openDetailModal(id) {
            fetch(`/KepalaDivisi/${id}/json`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nomor').textContent = data.nomor_dokumen;
                    document.getElementById('tanggal').textContent = data.tanggal_dokumen;
                    document.getElementById('pekerjaan').textContent = data.pekerjaan;
                    document.getElementById('tujuan').textContent = data.tujuan;
                    document.getElementById('status').textContent = data.status_verifikasi;

                    document.getElementById('btnLihatPdf').onclick = () => openPdfModal(`/dokumen/${data.id}/view`);

                    const modal = document.getElementById('detailModal');
                    const modalContent = modal.querySelector('.max-w-2xl');
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modalContent.classList.remove('scale-95', 'opacity-0');
                        modalContent.classList.add('scale-100', 'opacity-100');
                    }, 50);
                })
                .catch(() => alert('Gagal memuat detail dokumen.'));
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            const modalContent = modal.querySelector('.max-w-2xl');
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // === MODAL PDF ===
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

        document.getElementById('pdfModal').addEventListener('click', function (e) {
            const container = document.getElementById('pdfContainer');
            if (!container.contains(e.target) && e.target.id === 'pdfModal') closePdfModal();
        });
    </script>
</body>
</html>
