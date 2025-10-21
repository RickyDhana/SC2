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
    
    {{-- Style kustom untuk animasi --}}
    <style>
        @keyframes modalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes subtlePulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.85; }
        }
        .animate-modalFadeIn {
            animation: modalFadeIn 0.3s ease-out;
        }
        .animate-modalSlideIn {
            animation: modalSlideIn 0.3s ease-out;
        }
        .animate-subtlePulse {
            animation: subtlePulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

{{-- Background body cerah --}}
<body class="bg-gray-100 font-sans">
    {{-- Navbar --}}
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

    {{-- Sidebar --}}
    <div class="flex">
        {{-- MENGEMBALIKAN SIDEBAR KE STYLE AWAL --}}
        <aside
            class="group left-0 bg-gradient-to-b from-[#0a1730] to-[#1c2e55] text-white h-[calc(100vh-96px)] flex flex-col transition-all duration-300 w-24 hover:w-64">
            <nav class="flex flex-col justify-between h-full w-full px-6 pt-8">
                <div class="flex flex-col space-y-8">
                    <a href="{{ route('dashboard.show') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('dashboard*') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-search text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">
                            Cek Dokumen</span>
                    </a>

                    <a href="{{ url('/input-dokumen') }}"
                        class="flex items-center space-x-4 p-2 rounded-md hover:bg-black/25 transition-all duration-200 {{ request()->is('input-dokumen') ? 'border-b-2 border-white' : '' }}">
                        <i class="fas fa-file-upload text-2xl pr-2"></i>
                        <span
                            class="w-0 overflow-hidden group-hover:w-auto group-hover:opacity-100 transition-all duration-300 font-medium whitespace-nowrap">
                            Input Dokumen</span>
                    </a>
                </div>
            </nav>
        </aside>

        {{-- Main Content (Tampilan tetap cantik) --}}
        <main class="flex-1 p-8">
            {{-- Kartu Pengecekan --}}
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg mb-8">
                <form action="{{ route('dashboard.search') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label for="nomor_dokumen" class="block text-sm font-medium text-gray-700 mb-2">Nomor Dokumen</label>
                            <input type="text" id="nomor_dokumen" name="nomor_dokumen"
                                value="{{ request('nomor_dokumen') }}" placeholder="Masukkan Nomor Dokumen"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                required>
                        </div>

                        @if(isset($dokumen))
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dokumen</label>
                                <input type="date" value="{{ $dokumen->tanggal_dokumen }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                <input type="text" value="{{ $dokumen->pekerjaan }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan</label>
                                <input type="text" value="{{ $dokumen->tujuan }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-600" readonly>
                            </div>
                        @else
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dokumen</label><input
                                    type="text" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label><input
                                    type="text" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Tujuan</label><input
                                    type="text" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100"
                                    placeholder="-" readonly></div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-[#1a2641] text-white px-6 py-2 rounded-lg shadow-md hover:shadow-lg hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all duration-300 ease-in-out">
                            <i class="fas fa-search mr-2"></i>Cek Dokumen
                        </button>

                        @if(isset($dokumen) && $dokumen->file_pdf)
                            <button type="button" onclick="openPdfModal('{{ route('vendor.showFile', $dokumen->id) }}')"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:shadow-lg hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all duration-300 ease-in-out">
                                <i class="fas fa-file-pdf mr-2"></i>Lihat PDF
                            </button>
                        @endif
                    </div>
                </form>

                @if(request()->has('nomor_dokumen') && !isset($dokumen))
                    <div class="mt-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-lg flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3 text-red-600"></i>
                        <div>
                            Dokumen dengan nomor <strong class="font-semibold text-red-800">{{ request('nomor_dokumen') }}</strong> tidak ditemukan.
                        </div>
                    </div>
                @endif
            </div>

            <div id="pdfModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 animate-modalFadeIn"
                onclick="closePdfModal(event)">
                <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-5/6 relative flex flex-col animate-modalSlideIn"
                    onclick="event.stopPropagation()">
                    <div class="flex-1">
                        <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-lg" frameborder="0"></iframe>
                    </div>
                </div>
            </div>

            {{-- Histori Verifikasi (Tampilan tetap cantik) --}}
            <div class="bg-white rounded-xl shadow-lg">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 border-b border-gray-200 pb-4">Histori Verifikasi Dokumen</h2>

                    @if(isset($histori) && count($histori) > 0)
                        @php
                            $flow_status = [
                                'Juru Beli' => 'pending', 'Kepala Biro' => 'pending', 'Kepala Departemen' => 'pending', 'Kepala Divisi' => 'pending',
                            ];
                            foreach ($histori as $h) {
                                $pos = strtolower($h->posisi ?? '');
                                if (str_contains($pos, 'juru') && str_contains($pos, 'beli')) { $flow_status['Juru Beli'] = 'approved'; }
                                elseif (str_contains($pos, 'biro')) { $flow_status['Kepala Biro'] = 'approved'; }
                                elseif (str_contains($pos, 'departemen')) { $flow_status['Kepala Departemen'] = 'approved'; }
                                elseif (str_contains($pos, 'divisi')) { $flow_status['Kepala Divisi'] = 'approved'; }
                            }
                            $status = strtolower(trim($dokumen->status_verifikasi ?? ''));
                            $rejection_message = null;
                            if (preg_match('/ditolak\s*juru\s*beli/i', $status)) {
                                $flow_status['Juru Beli'] = 'rejected';
                                $rejection_message = 'Dokumen ditolak oleh Juru Beli';
                            } elseif (preg_match('/ditolak\s*kepala\s*biro/i', $status)) {
                                $flow_status['Kepala Biro'] = 'rejected';
                                $rejection_message = 'Dokumen ditolak oleh Kepala Biro';
                            } elseif (preg_match('/ditolak\s*kepala\s*departemen/i', $status)) {
                                $flow_status['Kepala Departemen'] = 'rejected';
                                $rejection_message = 'Dokumen ditolak oleh Kepala Departemen';
                            } elseif (preg_match('/ditolak\s*kepala\s*divisi/i', $status)) {
                                $flow_status['Kepala Divisi'] = 'rejected';
                                $rejection_message = 'Dokumen ditolak oleh Kepala Divisi';
                            }
                        @endphp

                        {{-- Diagram Alur Verifikasi --}}
                        <div class="w-full max-w-5xl mx-auto mb-10 p-4 rounded-lg overflow-x-auto">
                            <div class="flex items-center min-w-max">
                                @foreach($flow_status as $step => $status)
                                    @php
                                        $color_class = match($status) {
                                            'approved' => 'bg-green-500 text-white animate-subtlePulse',
                                            'rejected' => 'bg-red-600 text-white',
                                            default => 'bg-gray-400 text-white opacity-70',
                                        };
                                    @endphp
                                    <div class="flex-shrink-0 text-center">
                                        <div class="px-5 py-2 rounded-full shadow-md font-semibold text-sm {{ $color_class }} transition-all duration-300">
                                            {{ $step }}
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        @php
                                            $next_line_color = match($status) {
                                                'approved' => 'bg-green-400 animate-subtlePulse',
                                                'rejected' => 'bg-red-500',
                                                default => 'bg-gray-300',
                                            };
                                        @endphp
                                        <div class="flex-1 h-1.5 {{ $next_line_color }} mx-4 transition-all duration-300"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Tabel Histori --}}
                        <div class="overflow-x-auto border rounded-lg">
                            <table class="min-w-full text-sm">
                                <thead class="bg-[#1a2641] text-white">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Posisi</th>
                                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Juru Beli</th>
                                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Masuk</th>
                                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Keluar</th>
                                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($histori as $row)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4 text-gray-700 font-medium">{{ $row->posisi ?? '-' }}</td>
                                            <td class="py-3 px-4 text-gray-600">{{ $row->jurubeli ?? '-' }}</td>
                                            <td class="py-3 px-4 text-gray-600">{{ $row->tanggal_masuk ? date('d-m-Y H:i', strtotime($row->tanggal_masuk)) : '-' }}</td>
                                            <td class="py-3 px-4 text-gray-600">{{ $row->tanggal_keluar ? date('d-m-Y H:i', strtotime($row->tanggal_keluar)) : '-' }}</td>
                                            <td class="py-3 px-4 text-gray-600 min-w-[200px]">{{ $row->catatan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pesan Penolakan --}}
                        @if($rejection_message)
                            @php
                                $latest_reject_note = collect($histori)->filter(function($item) {
                                    return str_contains(strtolower($item->catatan ?? ''), 'ditolak');
                                })->last();
                            @endphp
                            <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                                <div class="flex">
                                    <i class="fas fa-exclamation-circle mr-3 mt-1 text-red-600"></i>
                                    <div>
                                        <strong class="font-semibold text-red-800">{{ $rejection_message }}</strong>
                                        @if($latest_reject_note && $latest_reject_note->catatan)
                                            <p class="mt-1 text-sm">Catatan: "{{ $latest_reject_note->catatan }}"</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if(isset($dokumen))
                            <div class="text-center py-10 text-gray-500">
                                <i class="fas fa-info-circle text-4xl mb-3 text-gray-400"></i>
                                <p class="text-lg font-medium">Belum Ada Histori</p>
                                <p class="text-sm">Dokumen sedang dalam antrean atau belum memasuki alur verifikasi.</p>
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

        function closePdfModal(event, forceClose = false) {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            if (event.target === modal || forceClose) {
                viewer.src = "";
                modal.classList.add('hidden');
            }
        }
    </script>
</body>

</html>