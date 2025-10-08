<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Verifikator 1</title>
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
                                    <a href="{{ route('v1.show', $d->id) }}"
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>