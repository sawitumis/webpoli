<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index()
    // {
    //     $informasis = Informasi::latest()->get();
    //     return view('informasi', compact('informasis'));
    // }
    {
        return view('informasi.visi and misi');
    }

    public function create()
    {
        return view('informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'nullable|string',
        ]);

        Informasi::create($request->all());
        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'nullable|string',
        ]);

        $informasi = Informasi::findOrFail($id);
        $informasi->update($request->all());

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Informasi::findOrFail($id)->delete();
        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus!');
    }
}
