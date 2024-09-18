<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-yellow-200 text-gray-800 flex flex-col items-center min-h-screen font-serif">
    <header class="bg-brown-800 text-white py-5 w-full text-center animate-bounce-in">
    <h1 class="text-3xl font-bold">Edit Menu: {{ $menu->name }}</h1>
    </header>

    <main class="bg-yellow-100 border-2 border-brown-800 rounded-lg p-8 mt-10 w-full max-w-md shadow-lg animate-zoom-in" style="background: radial-gradient(circle, #ffd6d6, #ffe989);">
        <form action="{{ route('menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5 animate-slide-in">
                <label for="name" class="block text-lg font-medium mb-2">Nama</label>
                <input type="text" id="name" name="name" value="{{ $menu->name }}" required class="w-full p-3 border border-brown-800 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300">
            </div>
            <div class="mb-5 animate-slide-in">
                <label for="price" class="block text-lg font-medium mb-2">Harga</label>
                <input type="number" id="price" name="price" value="{{ $menu->price }}" required class="w-full p-3 border border-brown-800 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300">
            </div>
            <div class="mb-5 animate-slide-in">
                <label for="description" class="block text-lg font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" class="w-full p-3 border border-brown-800 rounded resize-none focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:scale-105 transition-transform duration-300" rows="4">{{ $menu->description }}</textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-yellow-400 text-gray-800 py-2 px-5 rounded shadow-md transition-transform transform hover:bg-yellow-500 hover:-translate-y-1 hover:scale-105 duration-300 animate-jiggle">Simpan Perubahan</button>
                <a href="{{ route('menus.index') }}" class="bg-red-600 text-white py-2 px-5 rounded shadow-md transition-transform transform hover:bg-red-700 hover:-translate-y-1 hover:scale-105 duration-300 animate-jiggle">Batal</a>
                <a href="{{ route('checkout') }}" class="bg-yellow-500 text-gray-800 py-2 px-4 rounded mt-3 transition-transform transform hover:bg-yellow-600 hover:-translate-y-1 hover:scale-105 duration-300 animate-jiggle">Checkout</a>
            </div>
        </form>
    </main>
    <style>
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes jiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }

        .animate-bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        .animate-zoom-in {
            animation: zoomIn 0.6s ease-out;
        }

        .animate-jiggle {
            animation: jiggle 0.2s ease-in-out;
        }
    </style>
</body>
</html>
