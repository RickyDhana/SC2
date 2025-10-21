<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT PAL - Input Dokumen</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="bg-gray-300 font-sans">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md p-0 flex justify-between">
        <div class="container mx-auto flex justify-between items-center px-6 py-5">
            <div>
                <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" class="h-12 md:h-14">
            </div>
            <nav class="flex items-center space-x-6 text-white">
                <a href="{{ route('home') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ url('dashboard') }}" class="hover:text-gray-300 transition">Dokumen Vendor</a>
                <a href="{{ url('login') }}"
                    class="border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0a1730] transition text-sm">
                    Login
                </a>
            </nav>
        </div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside
            class="group left-0 bg-gradient-to-b from-[#0a1730] to-[#1c2e55] text-white h-[calc(100vh-96px)] flex flex-col transition-all duration-300 w-24 hover:w-64">
            <nav class="flex flex-col justify-between h-full w-full px-6 pt-8">
                <div class="flex flex-col space-y-8">
                    <a href="{{ url('dashboard') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200">
                        <i class="fas fa-search text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Cek
                            Dokumen</span>
                    </a>

                    <a href="{{ url('/input-dokumen') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 border-b-2 border-white">
                        <i class="fas fa-file-upload text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Input
                            Dokumen</span>
                    </a>
                </div>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-10">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <form id="uploadForm" action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Nomor Dokumen -->
                        <div>
                            <label for="nomor_dokumen" class="block text-sm font-semibold text-gray-800 mb-2">
                                Nomor Dokumen
                            </label>
                            <input type="text" id="nomor_dokumen" name="nomor_dokumen"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p id="errorNomor" class="text-red-600 text-sm hidden mt-1">Harap isi Nomor Dokumen.</p>
                        </div>

                        <!-- Pekerjaan -->
                        <div>
                            <label for="pekerjaan" class="block text-sm font-semibold text-gray-800 mb-2">
                                Pekerjaan
                            </label>
                            <input type="text" id="pekerjaan" name="pekerjaan"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p id="errorPekerjaan" class="text-red-600 text-sm hidden mt-1">Harap isi Pekerjaan.</p>
                        </div>

                        <!-- Tujuan -->
                        <div>
                            <label for="tujuan" class="block text-sm font-semibold text-gray-800 mb-2">
                                Tujuan (Juru Beli)
                            </label>
                            <select id="tujuan" name="tujuan" required
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Pilih Tujuan</option>
                                @foreach($jurubelis as $role => $name)
                                    <option value="{{ $role }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <p id="errorTujuan" class="text-red-600 text-sm hidden mt-1">Harap pilih Tujuan.</p>
                        </div>

                        <!-- File PDF -->
                        <div>
                            <label for="file_pdf" class="block text-sm font-semibold text-gray-800 mb-2">
                                File Dokumen (PDF)
                            </label>
                            <label
                                class="flex items-center border border-dashed border-gray-400 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-100 transition">
                                <i class="fas fa-cloud-upload-alt mr-2 text-gray-600 text-lg"></i>
                                <span class="file-name text-gray-700 font-normal text-sm tracking-wide">Pilih PDF</span>
                                <input type="file" id="file_pdf" name="file_pdf" accept="application/pdf" class="hidden">
                            </label>
                            <p id="errorFile" class="text-red-600 text-sm hidden mt-1">Harap pilih file PDF sebelum upload.</p>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-800 transition-colors duration-200">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- POPUP KONFIRMASI -->
    <div id="confirmPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-96 text-center">
            <h2 class="text-lg font-bold mb-3 text-gray-800">Konfirmasi Data</h2>
            <p class="text-sm text-gray-600 mb-4">Pastikan data yang kamu isi sudah benar sebelum dikirim:</p>
            <div class="text-left text-gray-700 space-y-1 mb-5">
                <p><b>Nomor Dokumen:</b> <span id="confirmNomor"></span></p>
                <p><b>Pekerjaan:</b> <span id="confirmPekerjaan"></span></p>
                <p><b>Tujuan:</b> <span id="confirmTujuan"></span></p>
                <p><b>File:</b> <span id="confirmFile"></span></p>
            </div>
            <div class="flex justify-center space-x-4">
                <button id="cancelBtn"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Batal</button>
                <button id="confirmBtn"
                    class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Kirim Sekarang</button>
            </div>
        </div>
    </div>

    <!-- POPUP SUKSES -->
    <div id="successPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-80 text-center animate-fadeIn">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-3xl animate-bounce"></i>
                </div>
            </div>
            <h2 class="text-lg font-bold text-gray-800">Data Berhasil Dikirim!</h2>
            <p class="text-sm text-gray-600 mt-2">Dokumen kamu telah berhasil diupload.</p>
            <button id="okBtn"
                class="mt-5 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">OK</button>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-in-out; }
    </style>

    <script>
        const form = document.getElementById('uploadForm');
        const popup = document.getElementById('confirmPopup');
        const successPopup = document.getElementById('successPopup');
        const confirmNomor = document.getElementById('confirmNomor');
        const confirmPekerjaan = document.getElementById('confirmPekerjaan');
        const confirmTujuan = document.getElementById('confirmTujuan');
        const confirmFile = document.getElementById('confirmFile');

        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const okBtn = document.getElementById('okBtn');

        const fileInput = document.getElementById('file_pdf');
        const fileLabel = document.querySelector('.file-name');

        const fields = {
            nomor: document.getElementById('nomor_dokumen'),
            pekerjaan: document.getElementById('pekerjaan'),
            tujuan: document.getElementById('tujuan'),
            file: fileInput
        };

        const errors = {
            nomor: document.getElementById('errorNomor'),
            pekerjaan: document.getElementById('errorPekerjaan'),
            tujuan: document.getElementById('errorTujuan'),
            file: document.getElementById('errorFile')
        };

        // tampilkan nama file
        fileInput.addEventListener('change', () => {
            fileLabel.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : 'Pilih PDF';
            if (fileInput.files.length > 0) errors.file.classList.add('hidden');
        });

        // validasi dan tampilkan popup konfirmasi
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            let valid = true;

            // validasi field
            if (fields.nomor.value.trim() === '') { errors.nomor.classList.remove('hidden'); valid = false; } 
            else errors.nomor.classList.add('hidden');
            if (fields.pekerjaan.value.trim() === '') { errors.pekerjaan.classList.remove('hidden'); valid = false; } 
            else errors.pekerjaan.classList.add('hidden');
            if (!fields.tujuan.value) { errors.tujuan.classList.remove('hidden'); valid = false; } 
            else errors.tujuan.classList.add('hidden');
            if (!fields.file.files.length) { errors.file.classList.remove('hidden'); valid = false; } 
            else errors.file.classList.add('hidden');

            if (valid) {
                confirmNomor.textContent = fields.nomor.value;
                confirmPekerjaan.textContent = fields.pekerjaan.value;
                confirmTujuan.textContent = fields.tujuan.options[fields.tujuan.selectedIndex].text;
                confirmFile.textContent = fields.file.files[0]?.name || '-';
                popup.classList.remove('hidden');
            }
        });

        cancelBtn.addEventListener('click', () => popup.classList.add('hidden'));

        // saat menekan "Kirim Sekarang"
        confirmBtn.addEventListener('click', (e) => {
            popup.classList.add('hidden');
            // simulasi upload sukses (bisa diganti ajax)
            setTimeout(() => {
                successPopup.classList.remove('hidden');
            }, 600);
        });

        okBtn.addEventListener('click', () => {
            successPopup.classList.add('hidden');
            form.submit(); // kirim form ke server
        });
    </script>
</body>
</html>
