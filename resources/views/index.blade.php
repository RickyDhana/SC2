<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Chain Monitoring - PT PAL</title>

    {{-- DEPENDENSI UNTUK TAMPILAN & FUNGSI --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #d1d5db !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #6b7280 !important;
        }
    </style>
</head>

<body class="bg-[#0a1730] text-white font-sans">

    <header class="bg-gradient-to-r from-[#1c2e55] via-[#132445] to-[#0a1730] shadow-md mb-8">
        <div class="container mx-auto flex justify-between items-center px-6 py-5">
            <div>
                <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" class="h-12 md:h-14">
            </div>
            <nav class="flex items-center space-x-6">
                <a href="{{ url('home') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ url('dashboard') }}" class="hover:text-gray-300 transition">Dokumen Vendor</a>
                <a href="{{ url('login') }}" class="border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0a1730] transition text-sm">
                    Login
                </a>
            </nav>
        </div>
    </header>


    {{-- Konten Utama --}}
    <main class="flex-grow flex flex-col items-center justify-center text-center px-4 mt-28">
        <h1 class="text-3xl md:text-4xl font-bold mb-8">
            MAU DISI APA?
        </h1>

        {{-- Search box custom --}}
        <div class="flex w-full max-w-md space-x-2 mb-24">
            <input type="text" id="customSearchBox" placeholder="Find Dokumen"
                class="w-full px-4 py-2 rounded-md bg-transparent border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="searchButton" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                Find
            </button>
        </div>
    </main>

    <div class="bg-[#0f2041] p-4 sm:p-6 rounded-lg shadow-xl">
        <div class="overflow-x-auto">
            <table id="userTable" class="min-w-full text-sm" style="width:100%">
                <thead class="bg-[#1e2a47]">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">No</th>
                        <th class="px-4 py-3 font-semibold text-left tracking-wider">No Dokumen</th>
                        <th class="px-4 py-3 font-semibold text-left tracking-wider">Tanggal Dokumen</th>
                        <th class="px-4 py-3 font-semibold text-left tracking-wider">Perihal</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Tujuan</th>

                    </tr>
                </thead>
                @foreach($dokumen as $item)
                    <tr class="hover:bg-[#132445] transition-colors duration-200">
                    <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-left">{{ $item->nomor_dokumen }}</td>
                    <td class="px-4 py-3 text-left">{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d F Y') }}</td>
                    <td class="px-4 py-3 text-left">{{ $item->perihal }}</td>
                    <td class="px-4 py-3 text-center">{{ $item->tujuan }}</td>
                    </tr>
                    @endforeach

        </div>

        {{-- DEPENDENSI JAVASCRIPT --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('#userTable').DataTable({
                    scrollX: true,
                    paging: true,
                    pageLength: 20,
                    lengthChange: false,
                    ordering: false,
                    dom: 'rt<"flex justify-between mt-4"ip>' // ❌ hilangkan search bawaan
                });

                // Fungsi search pakai box custom
                $('#searchButton').on('click', function(e) {
                    e.preventDefault();
                    table.search($('#customSearchBox').val()).draw();
                });

                // Enter untuk langsung search
                $('#customSearchBox').on('keyup', function(e) {
                    if (e.key === 'Enter') {
                        table.search(this.value).draw();
                    }
                });
            });
        </script>

</body>

</html>