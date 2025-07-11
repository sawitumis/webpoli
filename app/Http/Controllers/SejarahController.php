<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function index()
    // {
    //     $sejarah = Sejarah::latest()->first();
    //     return view('Sejarah', compact('sejarah'));
    // }
        {
       
            return view('informasi.sejarah');
        }
    


    public function edit()
    {
        $sejarah = Sejarah::latest()->first();
        return view('sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'konten' => 'required|string',
        ]);

        $sejarah = Sejarah::latest()->first();
        if (!$sejarah) {
            $sejarah = Sejarah::create($request->all());
        } else {
            $sejarah->update($request->all());
        }

        return redirect()->route('sejarah.index')->with('success', 'Konten sejarah berhasil diperbarui!');
    }
}

