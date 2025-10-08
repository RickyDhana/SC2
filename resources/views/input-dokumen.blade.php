<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Dokumen - Penera</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="bg-gray-300 font-sans">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-[#1a2641] to-[#0a1730] shadow-md">
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
        <aside
            class="group left-0 bg-gradient-to-b from-[#1a2641] to-[#0a1730] text-white h-[calc(100vh-96px)] flex flex-col transition-all duration-300 w-24 hover:w-64">
            <nav class="flex flex-col justify-between h-full w-full px-6 pt-8">
                <div class="flex flex-col space-y-8">
                    <a href="{{ url('dashboard') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('dashboarduser') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-search text-2xl pr-2"></i>
                        <span class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Cek Dokumen</span>
                    </a>

                    <a href="{{ url('/input-dokumen') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('input-dokumen') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-file-upload text-2xl pr-2"></i>
                        <span class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Input Dokumen</span>
                    </a>
                </div>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-10">
            <div class="bg-white p-8 rounded-lg shadow-lg">

                <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label for="nomor_dokumen" class="block text-sm font-semibold text-gray-800 mb-2">
                                Nomor Dokumen
                            </label>
                            <input type="text" id="nomor_dokumen" name="nomor_dokumen" placeholder="Nomor Dokumen"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="tanggal_dokumen" class="block text-sm font-semibold text-gray-800 mb-2">
                                Tanggal Dokumen
                            </label>
                            <input type="date" id="tanggal_dokumen" name="tanggal_dokumen"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="perihal" class="block text-sm font-semibold text-gray-800 mb-2">Perihal</label>
                            <input type="text" id="perihal" name="perihal" placeholder="Perihal"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="tujuan" class="block text-sm font-semibold text-gray-800 mb-2">Tujuan</label>
                            <input type="text" id="tujuan" name="tujuan" placeholder="Tujuan"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-800 transition-colors duration-200">
                            Upload
                        </button>
                        <label
                            class="flex items-center border border-dashed border-gray-400 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-100 transition">
                            <i class="fas fa-cloud-upload-alt mr-2 text-gray-600 text-lg"></i>
                            <span class="file-name text-gray-700 font-normal text-sm tracking-wide">Pilih PDF</span>
                            <input type="file" name="file_pdf" accept="application/pdf" class="hidden" required>
                        </label>

                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
    const fileInput = document.querySelector('input[name="file_pdf"]');
    const labelText = document.querySelector('.file-name');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files.length > 0) {
            labelText.textContent = this.files[0].name;
        } else {
            labelText.textContent = 'Pilih PDF';
        }
    });
</script>



</body>

</html>