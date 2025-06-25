<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    /**
     * Halaman utama manajemen biodata.
     * Logika: jika data ada, tampilkan form edit. Jika tidak, arahkan ke form create.
     */
    public function index()
    {
        $biodata = Biodata::first(); // Ambil data biodata pertama yang ada.

        if ($biodata) {
            // Jika data ditemukan, tampilkan halaman untuk mengeditnya.
            return view('biodatas.edit', compact('biodata'));
        }
        
        // Jika tidak ada data sama sekali, arahkan ke halaman untuk membuatnya.
        return redirect()->route('biodatas.create');
    }

    /**
     * Menampilkan form untuk membuat biodata baru.
     * Hanya bisa diakses jika belum ada data biodata sama sekali.
     */
    public function create()
    {
        if (Biodata::count() > 0) {
            return redirect()->route('biodatas.index')->withErrors('Anda hanya bisa memiliki satu data biodata.');
        }
        return view('biodatas.create');
    }

    /**
     * Menyimpan data biodata yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'bio_singkat'  => 'required|string|max:500',
            'email'        => 'required|email|unique:biodatas,email',
            'foto_profil'  => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imagePath = $request->file('foto_profil')->store('profile_photos', 'public');

        Biodata::create([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'bio_singkat'  => $validatedData['bio_singkat'],
            'email'        => $validatedData['email'],
            'foto_profil'  => $imagePath,
        ]);

        return redirect()->route('biodatas.index')->with('success', 'Biodata berhasil disimpan!');
    }

    /**
     * Menampilkan form untuk mengedit biodata (dipanggil oleh index).
     */
    public function edit(Biodata $biodata)
    {
        return view('biodatas.edit', compact('biodata'));
    }

    /**
     * Memperbarui data biodata yang sudah ada di database.
     */
    public function update(Request $request, Biodata $biodata)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'bio_singkat'  => 'required|string|max:500',
            'email'        => 'required|email|unique:biodatas,email,' . $biodata->id,
            'foto_profil'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $imagePath = $request->file('foto_profil')->store('profile_photos', 'public');
            Storage::disk('public')->delete($biodata->foto_profil);
            $validatedData['foto_profil'] = $imagePath;
        }

        $biodata->update($validatedData);

        return redirect()->route('biodatas.index')->with('success', 'Biodata berhasil diperbarui!');
    }
}
