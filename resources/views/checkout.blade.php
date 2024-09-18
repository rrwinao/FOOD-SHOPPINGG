<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Angkringan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@zxing/library@latest/dist/index.min.js"></script>
    <script src="{{ asset('js/scan.js') }}"></script>
</head>
<body class="bg-orange-50 text-gray-900 flex flex-col items-center font-serif min-h-screen">
    <header class="bg-yellow-800 text-white py-5 w-full text-center flex flex-col items-center shadow-lg animate-slideInDown">
        <h1 class="text-4xl font-bold mb-2 animate-pulse">Checkout Angkringan Jogja</h1>
        <p class="mt-2 text-sm italic animate-bounce">Hidangan sederhana, rasa luar biasa</p>
    </header>

    <main class="mt-10 w-full max-w-md p-4">
        <form action="{{ route('checkout.store') }}" method="POST" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 animate-popIn">
            @csrf
            
            <!-- Menampilkan Pesanan -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4 text-yellow-800 animate-bounceIn">Pesanan Anda:</h2>
                @if (session('cart') && count(session('cart')) > 0)
                    @php
                        $cart = session('cart');
                        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
                        $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
                    @endphp
                    @foreach($cart as $item)
                        <div class="mb-2 flex justify-between text-sm text-gray-700 animate-slideInLeft">
                            <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                            <span>Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div class="mt-4 text-xl font-bold flex justify-between text-yellow-800 animate-slideInRight">
                        <span>Total:</span>
                        <span>Rp. {{ $totalPriceFormatted }}</span>
                    </div>
                @else
                    <p class="text-center text-red-600 text-lg animate-wiggle">Keranjang Anda kosong.</p>
                @endif
            </div>

            <!-- Alamat Pengiriman -->
            <div class="mb-6">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat Pengiriman:</label>
                <textarea id="address" name="address" required class="shadow appearance-none border border-yellow-800 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition-transform transform hover:scale-105 duration-300"></textarea>
            </div>

            <!-- QR Code Pembayaran --> 
            @if(session('cart') && count(session('cart')) > 0)
            <div class="mb-6 text-center animate-popIn">
                <h3 class="text-lg font-bold mb-2 text-yellow-800">Scan untuk Membayar</h3>
                <p class="text-sm text-gray-600 mb-4">Gunakan aplikasi pembayaran untuk memindai QR Code ini.</p>
                <div class="flex justify-center animate-bounceSlow">
                    {!! QrCode::size(200)->generate(route('thankyou')) !!}
                </div>
            </div>
            @endif

            <!-- Tombol Bayar dan Kembali -->
            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-yellow-800 text-white py-2 px-4 rounded shadow-md transition-transform transform hover:bg-yellow-700 hover:-translate-y-1 hover:scale-105 duration-300 button-animated">Bayar</button>
                <a href="{{ route('menus.index') }}" class="bg-yellow-800 text-white py-2 px-4 rounded shadow-md transition-transform transform hover:bg-yellow-700 hover:-translate-y-1 hover:scale-105 duration-300 button-animated">Kembali ke Menu</a>
            </div>
        </form>
    </main>
    
    <!-- Area Pemindaian QR Code -->
    <div id="scanner-container" class="scanner-container fixed top-0 left-0 w-full h-full bg-black bg-opacity-50-flex items-center justify-center z-50 hidden">
        <div id="scanner" class="scanner relative bg-white border border-yellow-800 rounded"></div>
        <button onclick="closeScanner()" class="absolute top-2 right-2 bg-yellow-800 text-white py-1 px-3 rounded shadow-md transition-transform transform hover:bg-yellow-700 hover:-translate-y-1 hover:scale-105 duration-300">Tutup</button>
    </div>

    <script src="https://unpkg.com/quagga/dist/quagga.min.js"></script>
    <script>
        // Fungsi untuk membuka kamera pemindai menggunakan Quagga
        function openScanner() {
            document.getElementById('scanner-container').classList.remove('hidden');
            Quagga.init({
                inputStream: {
                    type: "LiveStream",
                    target: document.querySelector('#scanner'),
                    constraints: {
                        facingMode: "environment" // Gunakan kamera belakang
                    }
                },
                decoder: {
                    readers: ["qr_reader"]
                }
            }, 
            function(err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            });
                
            Quagga.onDetected(function(result) {
                var code = result.codeResult.code;
                console.log("QR Code Detected:", code);
                if (code) {
                window.location.href = "{{ route('thankyou') }}";
                closeScanner();}
            });
        }

        // Fungsi untuk menutup kamera pemindai
        function closeScanner() {
            Quagga.stop();
            document.getElementById('scanner-container').classList.add('hidden');
        }

        //kamera
         openScanner();
    </script>

    <style>
        @keyframes slideInDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes popIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes scanning {
             from { top: 20px; }
             to { top: calc(100% - 20px); }
        }

        .animate-slideInDown { animation: slideInDown 0.6s ease-out; }
        .animate-popIn { animation: popIn 0.6s ease-out; }
        .animate-slideInLeft { animation: slideInLeft 0.6s ease-out; }
        .animate-slideInRight { animation: slideInRight 0.6s ease-out; }
        .animate-wiggle { animation: wiggle 0.8s ease-in-out infinite; }
        .animate-bounceSlow { animation: bounceSlow 2s infinite; }
        .animate-bounceIn { animation: bounceIn 1s ease-out; }
        .scanner-container { animation: fadeIn 0.5s ease-in-out;}
        
        .scanner {
            width: 300px;
            height: 300px;
            border-radius: 10px;
            border: 4px solid #ffcc00;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: popIn 0.5s ease-out;
        }
        .scanner-container .scanner:before {
            content: 'Arahkan QR Code ke sini';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #ffcc00;
            font-size: 18px;
            font-weight: bold;
        }
        .scanner-container .scanner:after {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #ffcc00;
            transform: translateX(-50%);
            animation: scanning 1.5s linear infinite;
        }
        @keyframes scanning {
            from { top: 20px; }
            to { top: calc(100% - 20px); }
        }

        //opsiaonal
          @keyframes popIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
        }
        
         @keyframes scanning {
        from { top: 20px; }
        to { top: calc(100% - 20px); }
        }
        
        .close-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        z-index: 100;
    }
</style>
    </style>
</body>
</html>
