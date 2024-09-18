<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        // Simpan pesanan ke database, kirim email, atau proses lainnya
        session()->forget('cart'); // Kosongkan keranjang setelah checkout
        return redirect()->route('menus.index')->with('success', 'Pesanan Anda berhasil diproses!');
    }

    public function showCheckout()
    {
        $cart = session('cart');
        $totalPrice = 0;

        // Hitung total harga
        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        // Format total harga
        $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');

        // Kirim data ke view
        return view('checkout', [
            'totalPriceFormatted' => $totalPriceFormatted,
        ]);
    }
    public function processPayment(Request $request)
    {
        return redirect()->route('terima-kasih');
    }

}
