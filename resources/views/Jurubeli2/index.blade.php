<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jurubeli 2</title>
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
                Daftar Dokumen Menunggu Verifikasi
            </h2>

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

    {{-- 🔍 MODAL DETAIL DOKUMEN --}}
    <div id="detailModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-white text-gray-900 p-6 rounded-lg shadow-lg w-11/12 md:w-2/3 relative">
            <button onclick="closeDetailModal()"
                class="absolute top-2 right-3 text-gray-700 hover:text-red-600 text-3xl font-bold">&times;</button>

            <h2 class="text-xl font-bold mb-4">Detail Dokumen</h2>

            <div id="detailContent" class="space-y-2 mb-4">
                <p><strong>Nomor Dokumen:</strong> <span id="nomor"></span></p>
                <p><strong>Tanggal:</strong> <span id="tanggal"></span></p>
                <p><strong>Pekerjaan:</strong> <span id="pekerjaan"></span></p>
                <p><strong>Tujuan:</strong> <span id="tujuan"></span></p>
                <p><strong>Status:</strong> <span id="status"></span></p>

                <button id="btnLihatPdf" class="text-blue-600 underline">
                    📄 Lihat File PDF
                </button>
            </div>

            {{-- Tombol Setujui / Tolak --}}
            <div class="mt-6 flex gap-4">
                <form id="formSetujui" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Setujui
                    </button>
                </form>

                <form id="formTolak" method="POST" class="flex-1">
    @csrf
    <textarea name="keterangan" id="keterangan" rows="2"
        class="border text-sm w-full rounded p-2 mb-1"
        placeholder="Alasan penolakan"></textarea>
    <p id="errorKeterangan" class="text-red-600 text-sm hidden mb-2">Harap isi alasan penolakan.</p>

    <button type="submit"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full transition">
        Tolak
    </button>
</form>

            </div>
        </div>
    </div>

   {{-- 📄 MODAL LIHAT PDF --}}
<div id="pdfModal"
    class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
    <div id="pdfContainer" class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 relative">
    <iframe id="pdfViewer" src="" class="w-full h-full rounded-lg" frameborder="0"></iframe>
</div>

</div>

<script>
    // === MODAL DETAIL ===
    function openDetailModal(id) {
        fetch(`/Jurubeli2/${id}/json`)
            .then(res => {
                if (!res.ok) throw new Error('Gagal memuat data dokumen');
                return res.json();
            })
            .then(data => {
                document.getElementById('nomor').textContent = data.nomor_dokumen;
                document.getElementById('tanggal').textContent = data.tanggal_dokumen;
                document.getElementById('pekerjaan').textContent = data.pekerjaan;
                document.getElementById('tujuan').textContent = data.tujuan;
                document.getElementById('status').textContent = data.status_verifikasi;

                // Tombol lihat PDF (popup)
                document.getElementById('btnLihatPdf').onclick = () => {
                    openPdfModal(`/dokumen/${data.id}/view`);
                };

                // Set action form
                document.getElementById('formSetujui').action = `/Jurubeli2/${data.id}/setujui`;
                document.getElementById('formTolak').action = `/Jurubeli2/${data.id}/tolak`;

                document.getElementById('detailModal').classList.remove('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memuat detail dokumen.');
            });
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('keterangan').value = '';
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

    // 🔹 Tutup modal PDF kalau klik di luar area file
    document.getElementById('pdfModal').addEventListener('click', function (e) {
        const container = document.getElementById('pdfContainer');
        if (!container.contains(e.target)) {
            closePdfModal();
        }
    });

    // 🔸 Validasi alasan penolakan wajib diisi
document.getElementById('formTolak').addEventListener('submit', function (e) {
    const alasan = document.getElementById('keterangan').value.trim();
    const errorText = document.getElementById('errorKeterangan');

    if (alasan === '') {
        e.preventDefault();
        errorText.classList.remove('hidden');
    } else {
        errorText.classList.add('hidden');
    }
});

</script>
</body>

</html>
