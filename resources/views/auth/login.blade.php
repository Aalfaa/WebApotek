<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Apotek Alfina Rizqy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #A80505; --primary-dark: #6C0000; }
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md transform-gpu transition-all">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block">
                <img src="{{ asset('assets/images/logo_apotek.png') }}" class="h-16 w-auto mx-auto mb-4" alt="Logo">
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500 text-sm">Silakan masuk untuk melanjutkan pesanan Anda</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)] outline-none transition-all bg-gray-50 focus:bg-white text-sm"
                           placeholder="email@gmail.com">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Kata Sandi</label>
                        <a href="#" class="text-xs font-medium text-[var(--primary)] hover:underline">Lupa Sandi?</a>
                    </div>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)] outline-none transition-all bg-gray-50 focus:bg-white text-sm"
                           placeholder="••••••••">
                </div>

                <button type="submit"
                        class="w-full bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white font-semibold py-3 rounded-xl shadow-lg shadow-red-200 transition-all active:scale-[0.98] transform-gpu">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 text-center border-t pt-6">
                <p class="text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-bold text-[var(--primary)] hover:underline">Daftar Gratis</a>
                </p>
            </div>
        </div>

        <div class="text-center mt-8 text-xs text-gray-400 tracking-wide">
            &copy; 2025 APOTEK ALFINA RIZQY. ALL RIGHTS RESERVED.
        </div>
    </div>

</body>
</html>
