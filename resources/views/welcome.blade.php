<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Arial', sans-serif; /* Font yang lebih modern */
        }
        main {
            flex: 1;
        }
        .hero {
            background-image: url('https://source.unsplash.com/1600x900/?lifestyle,beauty'); /* Gambar yang lebih ceria */
            background-size: cover;
            background-position: center;
        }
        nav {
            background: #ff6f61; /* Warna coral */
            color: white;
        }
        .btn {
            background-color: #ff6f61;
            color: white;
            padding: 0.75rem 1.5rem; /* Padding lebih besar */
            border-radius: 1rem; /* Radius lebih bulat */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Tambahkan efek transformasi */
            font-weight: bold;
        }
        .btn:hover {
            background-color: #e65c50; /* Coral gelap saat di-hover */
            transform: scale(1.05); /* Efek zoom saat di-hover */
        }
        .btn-primary {
            background-color: #ff3d00; /* Warna tombol utama */
        }
        .btn-primary:hover {
            background-color: #e63900; /* Warna saat hover untuk tombol utama */
        }
        .notification {
            background-color: #ffe5e5; /* Latar belakang notifikasi merah muda */
            border-left: 4px solid #ff3d00; /* Garis tepi merah tua */
            padding: 1rem;
            margin-bottom: 2rem;
            color: #b00020; /* Teks merah tua */
            border-radius: 0.5rem;
            font-weight: 500; /* Teks lebih tebal */
        }
        .logo {
            height: 60px; /* Sesuaikan tinggi logo */
            flex: 0 0 auto;
        }
        footer {
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800"> <!-- Latar belakang abu-abu muda -->
    <div id="app">
        <nav class="shadow-md py-5">
            <div class="container mx-auto flex justify-between items-center px-8">
                <img src="{{ asset('img/img.png') }}" alt="Logo" class="logo"> <!-- Ganti URL gambar logo dengan URL yang sesuai -->
                <div class="space-x-6 text-lg flex items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                Dashboard
                            </a>
                            <a href="{{ route('qrcode.index') }}" class="btn">
                                QRCODE
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <main class="text-center hero flex items-center justify-center h-screen">
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-900 bg-white bg-opacity-90 px-8 py-16 rounded-xl shadow-lg">


                <h1 class="text-6xl font-extrabold mb-8">Selamat Datang di Platform Kecantikan Kami</h1>
                <p class="text-gray-700 max-w-3xl mx-auto mb-12 leading-relaxed">Kami menyediakan produk berkualitas tinggi untuk membantu Anda tampil menawan setiap hari. Temukan koleksi terbaru kami dan nikmati pengalaman berbelanja yang menyenangkan!</p>
                <a href="#" class="btn btn-primary text-lg font-semibold">Jelajahi Sekarang</a>
            </div>
        </main>

        <footer class="bg-white shadow-inner py-7 mt-auto">
            <div class="container mx-auto text-center">
                &copy; 2025 Wa Kartika. Semua Hak Dilindungi. |
                <a href="#" class="text-red-600 hover:text-red-800">Kebijakan Privasi</a> |
                <a href="#" class="text-red-600 hover:text-red-800">Syarat dan Ketentuan</a>
            </div>
        </footer>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                isLoggedIn: false
            },
            mounted() {
                // Simulasi pemeriksaan status login
                axios.get('/api/user')
                    .then(response => {
                        if (response.data) {
                            this.isLoggedIn = true;
                        }
                    })
                    .catch(error => {
                        console.log('Gagal memeriksa status login', error);
                    });
            }
        });
    </script>
</body>
</html>
