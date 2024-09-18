<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // MENAMPILKAN SEMUA DAFTAR MENU
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    // UNTUK MENAMBAH MENU BARU
    public function create()
    {
        return view('menus.create');
    }

    // MENYIMPAN DATA BARU KE DATABASE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')
                         ->with('success', 'Menu berhasil ditambahkan!');
    }

    // FORM EDIT MENU YANG SUDAH ADA
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    // UNTUK UPDATE MENU YANG SUDAH ADA
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')
                         ->with('success', 'Menu berhasil diperbarui!');
    }

    // HAPUS MENU
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')
                         ->with('success', 'Menu berhasil dihapus!');
    }

    // MENAMBAHKAN MENU KE KERANJANG BELANJA
    public function addToCart(Request $request, $id)
    {
        $menu = Menu::find($id);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Jika item sudah ada di keranjang, tambahkan kuantitas
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika item belum ada di keranjang, tambahkan item ke dalam array
            $cart[$id] = [
                "name" => $menu->name,
                "price" => $menu->price,
                "quantity" => 1
            ];
        }

        // Simpan kembali keranjang ke dalam session
        session()->put('cart', $cart);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }
     
    public function checkout(Request $request)
{
    // Proses pembayaran...

    // Kosongkan keranjang setelah checkout
    session()->forget('cart');
    
    return redirect()->route('menus.index')->with('success', 'Pembayaran berhasil! Terima kasih atas pesanan Anda.');
}


    // MENAMPILKAN DETAIL MENU
    public function show($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        return view('menus.show', compact('menu'));
    }

    // public function search(Request $request){
    //     if($request->has('search')){
    //         $menu = Menu::Where('nama','LIKE', '%'.$request->search.'%')->get();
    //     }else {
    //         $menu = Menu::all();
    //     }return view('menus.index',['menu => $menu']);
    // }

    //UNTUK MENU MASUK DAN KELUAR
    // public function increaseStock(Request $request, Menu $menu)
    // {
    //     $menu->stock += $request->input('amount');
    //     $menu->save();
    
    //     return redirect()->route('menus.index')->with('success', 'Stok berhasil ditambahkan.');
    // }
    
    // public function decreaseStock(Request $request, Menu $menu)
    // {
    //     if ($menu->stock >= $request->input('amount')) {
    //         $menu->stock -= $request->input('amount');
    //         $menu->save();
    
    //         return redirect()->route('menus.index')->with('success', 'Stok berhasil dikurangi.');
    //     }
    
    //     return redirect()->route('menus.index')->with('error', 'Jumlah pengurangan stok melebihi stok yang ada.');
    // }
}    