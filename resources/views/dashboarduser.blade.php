<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT PAL - Cek Dokumen</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="bg-gray-300 font-sans">
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
        <aside
            class="group left-0 bg-gradient-to-b from-[#0a1730] to-[#1c2e55] text-white h-[calc(100vh-96px)] flex flex-col transition-all duration-300 w-24 hover:w-64">
            <nav class="flex flex-col justify-between h-full w-full px-6 pt-8">
                <div class="flex flex-col space-y-8">
                    <a href="{{ route('dashboard.show') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('dashboard*') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-search text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Cek
                            Dokumen</span>
                    </a>

                    <a href="{{ url('/input-dokumen') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('input-dokumen') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-file-upload text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">Input
                            Dokumen</span>
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 p-8">

            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <form action="{{ route('dashboard.search') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label for="nomor_dokumen" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Dokumen</label>
                            <input type="text" id="nomor_dokumen" name="nomor_dokumen"
                                value="{{ request('nomor_dokumen') }}" placeholder="Masukkan Nomor Dokumen"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        @if(isset($dokumen))
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dokumen</label>
                                <input type="date" value="{{ $dokumen->tanggal_dokumen }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" value="{{ $dokumen->pekerjaan }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan</label>
                                <input type="text" value="{{ $dokumen->tujuan }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                            </div>
                        @else
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dokumen</label><input
                                    type="text" class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label><input
                                    type="text" class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1">Tujuan</label><input
                                    type="text" class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-[#1a2641] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>Cek Dokumen
                        </button>

                        @if(isset($dokumen) && $dokumen->file_pdf)
                            <button type="button" onclick="openPdfModal('{{ route('vendor.showFile', $dokumen->id) }}')"
                                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-file-pdf mr-2"></i>Show PDF
                            </button>
                        @endif
                    </div>
                </form>

                @if(request()->has('nomor_dokumen') && !isset($dokumen))
                    <div class="mt-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-md">
                        Dokumen dengan nomor <strong>{{ request('nomor_dokumen') }}</strong> tidak ditemukan.
                    </div>
                @endif
            </div>

            <!-- Modal PDF -->
            <div id="pdfModal"
                class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                onclick="closePdfModal(event)">
                <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 relative"
                    onclick="event.stopPropagation()">
                    <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-lg" frameborder="0"></iframe>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-800">Histori Verifikasi Dokumen</h2>

                    @if(isset($histori) && count($histori) > 0)
                        @php
                            $flow_status = [
                                'Juru Beli' => 'pending',
                                'Kepala Biro' => 'pending',
                                'Kepala Departemen' => 'pending',
                                'Kepala Divisi' => 'pending',
                            ];
                            foreach ($histori as $h) {
                                if (isset($flow_status[$h->posisi])) {
                                    $flow_status[$h->posisi] = 'approved';
                                }
                            }
                            if (str_contains($dokumen->status_verifikasi, 'Ditolak Juru Beli'))
                                $flow_status['Juru Beli'] = 'rejected';
                            if (str_contains($dokumen->status_verifikasi, 'Ditolak Kepala Biro'))
                                $flow_status['Kepala Biro'] = 'rejected';
                            if (str_contains($dokumen->status_verifikasi, 'Ditolak Kepala Departemen'))
                                $flow_status['Kepala Departemen'] = 'rejected';
                        @endphp
                        <div class="w-full max-w-5xl mx-auto mb-8 p-4 rounded-lg">
                            <div class="flex items-center">
                                @foreach($flow_status as $verifier => $status)
                                    @php
                                        $color_class = 'bg-gray-400 text-white';
                                        if ($status === 'approved') {
                                            $color_class = 'bg-green-500 text-white';
                                        } elseif ($status === 'rejected') {
                                            $color_class = 'bg-red-600 text-white';
                                        }
                                    @endphp
                                    <div class="flex-shrink-0 text-center">
                                        <div class="px-5 py-2 rounded-full shadow-md font-semibold {{ $color_class }}">
                                            {{ $verifier }}
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="flex-1 h-1 bg-gray-300 mx-4"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border">
                                <thead class="bg-[#1a2641] text-white">
                                    <tr>
                                        <th class="py-3 px-4 text-left">Posisi</th>
                                        <th class="py-3 px-4 text-left">Juru Beli</th>
                                        <th class="py-3 px-4 text-left">Masuk</th>
                                        <th class="py-3 px-4 text-left">Keluar</th>
                                        <th class="py-3 px-4 text-left">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach($histori as $row)
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-3 px-4">{{ $row->posisi ?? '-' }}</td>
                                            <td class="py-3 px-4">{{ $row->verifikator ?? '-' }}</td>
                                            <td class="py-3 px-4">
                                                {{ $row->tanggal_masuk ? date('d-m-Y H:i', strtotime($row->tanggal_masuk)) : '-' }}
                                            </td>
                                            <td class="py-3 px-4">
                                                {{ $row->tanggal_keluar ? date('d-m-Y H:i', strtotime($row->tanggal_keluar)) : '-' }}
                                            </td>
                                            <td class="py-3 px-4">{{ $row->catatan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @if(isset($dokumen))
                            <div class="text-center py-4 text-gray-500">
                                <p>Dokumen sedang dalam antrean atau belum memasuki alur verifikasi.</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

        </main>
    </div>

    <script>
        function openPdfModal(url) {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            viewer.src = url;
            modal.classList.remove('hidden');
        }

        function closePdfModal(event) {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');

            if (event.target === modal) {
                viewer.src = "";
                modal.classList.add('hidden');
            }
        }
    </script>
</body>

</html>