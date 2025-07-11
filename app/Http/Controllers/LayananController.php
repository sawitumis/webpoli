<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
    //     $layanans = Layanan::all();
    //     return view('layanan', compact('layanans'));
        return view('layanan.index');
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($validated);
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($validated);
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}  

