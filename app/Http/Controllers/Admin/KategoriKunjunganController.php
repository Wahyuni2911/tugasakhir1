<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\KategoriKunjungan;
use App\Http\Controllers\Controller;

class KategoriKunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $kategori = KategoriKunjungan::when($query, function ($q) use ($query) {
                return $q->where('nama_kategori', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.kategori-kunjungan.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_kunjungan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:45',
        ]);

        KategoriKunjungan::create($request->only('nama_kategori'));

        return redirect()->route('kategori-kunjungan.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriKunjungan $kategori_kunjungan)
    {
        return view('admin.kategori-kunjungan.edit', ['kategori' => $kategori_kunjungan]);
    }

    public function update(Request $request, KategoriKunjungan $kategori_kunjungan)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:45',
        ]);

        $kategori_kunjungan->update($request->only('nama_kategori'));

        return redirect()->route('kategori-kunjungan.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriKunjungan $kategori_kunjungan)
    {
        $kategori_kunjungan->delete();

        return redirect()->route('kategori-kunjungan.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
