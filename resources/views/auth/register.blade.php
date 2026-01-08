<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Apotek Alfina Rizqy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #A80505; --primary-dark: #6C0000; }
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md transform-gpu">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block">
                <img src="{{ asset('assets/images/logo_apotek.png') }}" class="h-16 w-auto mx-auto mb-4" alt="Logo">
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm">Lengkapi data di bawah untuk bergabung</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)] outline-none transition-all bg-gray-50 focus:bg-white text-sm"
                           placeholder="Contoh: Budi Santoso">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)] outline-none transition-all bg-gray-50 focus:bg-white text-sm"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)] outline-none transition-all bg-gray-50 focus:bg-white text-sm"
                           placeholder="Minimal 8 karakter">
                </div>

                <div class="flex items-start gap-2 pt-2">
                    <input type="checkbox" required class="mt-1 accent-[var(--primary)]">
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Saya menyetujui <a href="#" class="text-[var(--primary)] underline">Syarat & Ketentuan</a> serta Kebijakan Privasi yang berlaku.
                    </p>
                </div>

                <button type="submit"
                        class="w-full bg-[var(--primary)] hover:bg-[var(--primary-dark)] text-white font-semibold py-3 rounded-xl shadow-lg shadow-red-200 transition-all active:scale-[0.98] transform-gpu">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-8 text-center border-t pt-6">
                <p class="text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-[var(--primary)] hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
