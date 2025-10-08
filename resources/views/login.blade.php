<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT PAL - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/PAL.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-[#0a1730] text-white min-h-screen flex justify-center">

    <div class="max-w-screen-xl m-0 sm:m-10 bg-[#1c2e55]/60 shadow sm:rounded-2xl flex flex-1">

        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col justify-center items-center">

            <div class="bg-white text-black rounded-2xl shadow-lg px-8 py-10 w-full max-w-sm">

                <img src="{{ asset('images/pal-logo.png') }}" class="w-60 mx-auto mb-16" alt="Logo PT PAL" />

                <form action="{{ route('login.post') }}" method="POST" class="w-full">
                    @csrf

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <i class="ph ph-envelope text-gray-400"></i>
                        </div>
                        <input
                            class="w-full px-4 py-3 pr-12 rounded-lg font-medium bg-transparent border border-gray-300 placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            type="email" name="email" placeholder="Email" required autofocus />
                    </div>

                    <div class="relative mb-6">
                        <input id="password"
                            class="w-full px-4 py-3 pr-12 rounded-lg font-medium bg-transparent border border-gray-300 placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            type="password" name="password" placeholder="Password" required />

                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i id="eyeIcon" class="ph ph-eye"></i>
                        </button>
                    </div>

                    <button type="submit"
                        class="tracking-wide font-semibold bg-blue-600 text-white w-full py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out">
                        Login
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 hidden lg:flex bg-center bg-cover bg-[url('{{ asset('images/kanan.jpg') }}')]">
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('ph-eye');
                eyeIcon.classList.add('ph-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('ph-eye-slash');
                eyeIcon.classList.add('ph-eye');
            }
        }
    </script>
</body>

</html>