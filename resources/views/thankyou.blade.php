<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-100 text-gray-900 flex flex-col items-center font-serif min-h-screen">
    <header class="bg-yellow-600 text-white py-5 w-full text-center flex flex-col items-center shadow-lg animate-fadeIn">
        <h1 class="text-4xl font-bold mb-2">Terima Kasih!</h1>
        <p class="mt-2 text-sm italic">Pembayaran Anda telah berhasil.</p>
    </header>
    
    <main class="mt-10 w-full max-w-md p-4">
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 text-center animate-bounceIn">
            <p class="text-lg font-bold mb-4 text-yellow-600">Terima kasih telah melakukan pembayaran di REN'AI KEISEKI!</p>
            <p class="text-gray-700">Kami akan segera memproses pesanan Anda. Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
            <a href="{{ route('menus.index') }}" class="bg-yellow-600 text-white py-2 px-4 rounded shadow-md mt-6 inline-block transition-transform transform hover:scale-105 duration-300 hover:bg-yellow-500">Kembali ke Menu</a>
        </div>
    </main>
    <style>
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            50% {
                opacity: 1;
                transform: scale(1.1);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-bounceIn {
            animation: bounceIn 1s ease-out;
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-out;
        }
    </style>
</body>
</html>
