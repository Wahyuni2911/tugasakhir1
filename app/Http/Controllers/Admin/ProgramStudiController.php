<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramStudi::query();

        if ($request->filled('query')) {
            $query->where('nama_prodi', 'like', '%' . $request->query . '%')
                ->orWhere('kode_prodi', 'like', '%' . $request->query . '%');
        }

        $prodi = $query->orderBy('nama_prodi')->paginate(10); // ✅ TANPA get()

        return view('admin.program-studi.index', compact('prodi'));
    }


    public function create()
    {
        return view('admin.program-studi.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:45',
            'kode_prodi' => 'required|string|max:45|unique:program_studi,kode_prodi',
        ]);

        ProgramStudi::create($request->only(['nama_prodi', 'kode_prodi']));

        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:50',
        ]);

        $prodi = ProgramStudi::findOrFail($id);
        $prodi->update($request->only(['nama_prodi', 'kode_prodi']));

        return redirect()->route('program-studi.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
