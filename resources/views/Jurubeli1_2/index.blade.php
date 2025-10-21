<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jurubeli</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
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
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition font-medium text-sm shadow-md">
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
        class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 overflow-y-auto backdrop-blur-sm transition-opacity duration-300">
        <div
            class="bg-white text-gray-900 p-8 rounded-xl shadow-2xl w-11/12 max-w-2xl relative transform scale-95 opacity-0 transition-all duration-300">

            {{-- Tombol Tutup --}}
            <button onclick="closeDetailModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 text-3xl font-light transition">&times;</button>

            <h2 class="text-2xl font-extrabold mb-2 border-b pb-3 text-[#1c2e55]">Detail Dokumen</h2>

            {{-- BAGIAN DETAIL DATA --}}
            <div id="detailContent" class="space-y-3 mb-6 pt-2">

                <div class="flex justify-between items-center py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Nomor Dokumen:</p>
                    <p class="text-sm font-bold text-gray-900" id="nomor"></p>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Tanggal:</p>
                    <p class="text-sm font-bold text-gray-900" id="tanggal"></p>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Pekerjaan:</p>
                    <p class="text-sm font-bold text-gray-900" id="pekerjaan"></p>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Tujuan:</p>
                    <p class="text-sm font-bold text-gray-900" id="tujuan"></p>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-dashed border-gray-200">
                    <p class="text-sm font-semibold text-gray-600">Status:</p>
                    <p class="text-sm font-bold text-blue-600" id="status"></p>
                </div>

                {{-- Tombol Lihat PDF yang Lebih Menonjol --}}
                <div class="text-center pt-4">
                    <button onclick="document.getElementById('pdfModal').classList.remove('hidden');" id="btnLihatPdf"
                        class="inline-flex items-center bg-blue-100 text-blue-700 font-bold px-4 py-2 rounded-full hover:bg-blue-200 transition text-sm shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        Lihat File Dokumen
                    </button>
                </div>
            </div>

            <hr class="mb-4">

            {{-- BAGIAN AKSI (VERIFIKASI) --}}
            <div class="mt-6">
                <h3 class="text-lg font-bold mb-3 text-gray-800">Tindakan Verifikasi</h3>

                <div class="flex flex-col md:flex-row gap-6">
                    {{-- ✅ FORM SETUJUI DENGAN DROPDOWN --}}
                    <form id="formSetujui" method="POST"
                        class="flex flex-col md:w-1/2 p-4 bg-green-50 rounded-lg border border-green-200">
                        @csrf
                        <label for="next_verifikator" class="text-sm font-bold text-green-700 mb-1">Verifikasi
                            Selanjutnya:</label>
                        <select name="next_verifikator" id="next_verifikator"
                            class="border border-green-300 rounded-md p-2 text-sm mb-3 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Pilih Kepala Biro --</option>
                            <option value="Kepala_Biro_1">Kepala Biro 1</option>
                            <option value="Kepala_Biro_2">Kepala Biro 2</option>
                            <option value="Kepala_Biro_3">Kepala Biro 3</option>
                        </select>
                        <p id="errorVerifikator" class="text-red-600 text-xs hidden mb-2 font-medium">Pilih verifikator
                            terlebih dahulu.</p>

                        <button type="submit"
                            class="bg-green-600 text-white font-bold px-4 py-3 rounded-lg hover:bg-green-700 transition shadow-md shadow-green-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Setujui
                        </button>
                    </form>

                    {{-- ❌ FORM TOLAK --}}
                    <form id="formTolak" method="POST" class="flex-1 p-4 bg-red-50 rounded-lg border border-red-200">
                        @csrf
                        <label for="keterangan" class="text-sm font-bold text-red-700 mb-1">Alasan Penolakan:</label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                            class="border border-red-300 text-sm w-full rounded-md p-2 mb-2 focus:ring-red-500 focus:border-red-500 placeholder-gray-400"
                            placeholder="Harap isi alasan penolakan secara jelas"></textarea>
                        <p id="errorKeterangan" class="text-red-600 text-xs hidden mb-2 font-medium">Harap isi alasan
                            penolakan.</p>
                        <button type="submit"
                        class="bg-red-600 text-white font-bold px-4 py-3 rounded-lg hover:bg-red-700 w-full transition shadow-md shadow-red-300 flex items-center justify-center mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Tolak
                    </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- 📄 MODAL LIHAT PDF --}}
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
            fetch(`/Jurubeli1_2/${id}/json`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nomor').textContent = data.nomor_dokumen;
                    document.getElementById('tanggal').textContent = data.tanggal_dokumen;
                    document.getElementById('pekerjaan').textContent = data.pekerjaan;
                    document.getElementById('tujuan').textContent = data.tujuan;
                    document.getElementById('status').textContent = data.status_verifikasi;

                    document.getElementById('btnLihatPdf').onclick = () => openPdfModal(`/dokumen/${data.id}/view`);

                    document.getElementById('formSetujui').action = `/Jurubeli1_2/${data.id}/setujui`;
                    document.getElementById('formTolak').action = `/Jurubeli1_2/${data.id}/tolak`;

                    const modal = document.getElementById('detailModal');
                    const modalContent = modal.querySelector('.max-w-2xl');

                    modal.classList.remove('hidden');
                    // Menunggu sebentar agar transisi berjalan
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

            // Sembunyikan setelah transisi selesai
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('keterangan').value = '';
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
            // Menutup modal jika klik di luar container PDF
            if (!container.contains(e.target) && e.target.id === 'pdfModal') closePdfModal();
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

        // 🔸 Validasi dropdown verifikator
        document.getElementById('formSetujui').addEventListener('submit', function (e) {
            const verifikator = document.getElementById('next_verifikator').value.trim();
            const errorText = document.getElementById('errorVerifikator');

            if (verifikator === '') {
                e.preventDefault();
                errorText.classList.remove('hidden');
            } else {
                errorText.classList.add('hidden');
            }
        });
    </script>
</body>

</html>