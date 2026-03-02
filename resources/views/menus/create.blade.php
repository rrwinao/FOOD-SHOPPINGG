<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-200 text-gray-800 flex flex-col items-center">
    <header class="bg-brown-800 text-white py-5 w-full text-center animate-slide-in-down">
        <h1 class="text-3xl font-bold">TAMBAH MENU FAVORITMU</h1>
    </header>
    <main class="bg-yellow-200 border-2 border-brown-800 rounded-lg p-8 mt-10 w-full max-w-md shadow-lg animate-fade-in-up">
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="name" class="block text-lg font-medium mb-2">Menu</label>
                <input type="text" id="name" name="name" required class="w-full p-3 border border-brown-800 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300">
            </div>
            <div class="mb-5">
                <label for="price" class="block text-lg font-medium mb-2">Harga</label>
                <input type="number" id="price" name="price" required class="w-full p-3 border border-brown-800 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300">
            </div>
            <div class="mb-5">
                <label for="description" class="block text-lg font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" class="w-full p-3 border border-brown-800 rounded resize-none focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300" rows="4"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-yellow-400 text-gray-800 py-2 px-5 rounded shadow-md transition-transform transform hover:bg-yellow-500 hover:-translate-y-1 hover:scale-105 duration-300">Tambah Menu</button>
                <a href="{{ route('menus.index') }}" class="bg-red-600 text-white py-2 px-5 rounded shadow-md transition-transform transform hover:bg-red-700 hover:-translate-y-1 hover:scale-105 duration-300">Batal</a>
                <a href="{{ route('checkout') }}" class="bg-yellow-500 text-gray-800 py-2 px-5 rounded shadow-md transition-transform transform hover:bg-yellow-600 hover:-translate-y-1 hover:scale-105 duration-300">Checkout</a>
            </div>
        </form>
    </main>

    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slide-in-down {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
         @keyframnes bounce{
            0%, 100% {transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframnes gradient-background {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
         }
         
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-slide-in-down {
            animation: slide-in-down 0.7s ease-out forwards;
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        .animate-pulse {
            animation: pulse 1s infinite;
        } 

        .animate-gradient-background {
            background: linear-gradient(45deg, #fbbf24, #f59e0b, #fbbf24);
            background-size: 200% 200%;
            animation: gradient-background 8s ease infinite;
        }
    </style>
</body>
</html>
