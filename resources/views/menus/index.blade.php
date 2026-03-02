<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-100 text-gray-800 flex flex-col items-center">
    <header class="bg-brown-800 text-white py-5 w-full text-center flex flex-col items-center">
        <h1 class="text-4xl font-bold text-yellow-500 drop-shadow-md">REN'AI KAISEKI</h1>
        <a href="{{ route('menus.create') }}" class="bg-yellow-400 text-gray-800 py-2 px-4 rounded mt-3 transition duration-300 hover:bg-yellow-500">Tambah Menu</a>
    </header>
    
    <!-- Fitur Pencarian -->
    <div class="search-bar mt-5 max-w-md w-full flex">
        <input type="text" placeholder="Cari menu..." class="w-full p-2 border-2 border-brown-800 rounded-l text-lg">
        <button type="button" class="bg-yellow-400 text-gray-800 py-2 px-4 rounded-r transition duration-300 hover:bg-yellow-500">Cari</button>
    </div>

    <main class="mt-10 w-full max-w-md">
        <!-- Cek menu -->
        @if ($menus->isEmpty())
          <p class="text-center text-brown-800 text-lg">Belum ada menu yang tersedia</p>
        @else
            <ul class="space-y-4">
                @foreach ($menus as $menu)
                    <li class="bg-yellow-200 border-2 border-brown-800 rounded p-5 transform transition duration-200 hover:scale-105">
                        <h2 class="text-2xl font-bold mb-2">{{ $menu->name }}</h2>
                        <p class="mb-2">Harga: Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                        <p class="mb-4">{{ $menu->description }}</p>
                        
                        <form action="{{ route('menus.addToCart', $menu->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-400 text-gray-800 py-2 px-4 rounded transition duration-300 hover:bg-yellow-500">Tambah</button>
                        </form>
                        
                        <a href="{{ route('menus.edit', $menu) }}" class="bg-yellow-400 text-gray-800 py-2 px-4 rounded transition duration-300 hover:bg-yellow-500">Ubah</a>
                        <a href="{{ route('checkout') }}" class="bg-yellow-500 text-gray-800 py-2 px-4 rounded mt-3 transition duration-300 hover:bg-yellow-600">Checkout</a>
                
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded ml-2 transition duration-300 hover:bg-red-700">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</body>
</html>
