<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiodataApiController extends Controller
{
    // Tampilkan semua biodata (jika mendukung multi user)
    public function index()
    {
        return response()->json($this->formatCollection(Biodata::latest()->get()));
    }

    // Tampilkan detail spesifik (show)
    public function show(Biodata $biodata)
    {
        return response()->json($this->format($biodata));
    }

    // Simpan data baru (create)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'bio_singkat'  => 'required|string|max:500',
            'email'        => 'required|email|unique:biodatas,email',
            'foto_profil'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['nama_lengkap', 'bio_singkat', 'email']);

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('profile_photos', 'public');
        }

        $biodata = Biodata::create($data);

        return response()->json($this->format($biodata), 201);
    }

    // Update data
    public function update(Request $request, Biodata $biodata)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'bio_singkat'  => 'required|string|max:500',
            'email'        => 'required|email|unique:biodatas,email,' . $biodata->id,
            'foto_profil'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['nama_lengkap', 'bio_singkat', 'email']);

        if ($request->hasFile('foto_profil')) {
            // Hapus gambar lama
            if ($biodata->foto_profil) {
                Storage::disk('public')->delete($biodata->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profile_photos', 'public');
        }

        $biodata->update($data);

        return response()->json($this->format($biodata));
    }

    // Hapus data
    public function destroy(Biodata $biodata)
    {
        if ($biodata->foto_profil) {
            Storage::disk('public')->delete($biodata->foto_profil);
        }

        $biodata->delete();

        return response()->json(['message' => 'Biodata berhasil dihapus.']);
    }

    // Format response 1 item
    private function format(Biodata $biodata)
    {
        return [
            'id'              => $biodata->id,
            'nama_lengkap'    => $biodata->nama_lengkap,
            'bio_singkat'     => $biodata->bio_singkat,
            'email'           => $biodata->email,
            'foto_profil_url' => $biodata->foto_profil ? asset('storage/' . $biodata->foto_profil) : null,
            'dibuat'          => $biodata->created_at->format('d F Y'),
        ];
    }

    // Format response banyak item
    private function formatCollection($items)
    {
        return $items->map(fn($b) => $this->format($b));
    }

    public function utama()
{
    $biodata = Biodata::latest()->first(); // atau pakai where user_id jika multiuser
    if (!$biodata) {
        return response()->json(['message' => 'Biodata tidak ditemukan'], 404);
    }

    return response()->json($this->format($biodata));
}
}


