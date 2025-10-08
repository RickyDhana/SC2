<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Verifikator 1 - PT PAL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0a1730] text-white min-h-screen">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md p-4 flex justify-between">
        <h1 class="text-lg font-bold">Dashboard Verifikator 1</h1>
        <a href="{{ route('logout') }}" class="text-sm text-white hover:underline">Logout</a>
    </header>

    {{-- Konten utama --}}
    <main class="p-6">
        <h2 class="text-2xl font-bold mb-6">Daftar Dokumen Menunggu Verifikasi</h2>

        <table class="min-w-full bg-white text-black rounded-lg overflow-hidden">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nomor Dokumen</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Perihal</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokumen as $d)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $d->nomor_dokumen }}</td>
                        <td class="px-4 py-2">{{ $d->tanggal_dokumen }}</td>
                        <td class="px-4 py-2">{{ $d->perihal }}</td>
                        <td class="px-4 py-2">{{ $d->status_verifikasi }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('v1.show', $d->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Periksa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
