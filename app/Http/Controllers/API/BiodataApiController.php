<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiodataApiController extends Controller
{
    /**
     * READ
     * Mengambil data biodata yang ada.
     */
    public function index()
    {
        $biodata = Biodata::first();
        if (!$biodata) {
            return response()->json(['message' => 'Biodata not found.'], 404);
        }
        return response()->json($this->format($biodata));
    }

    /**
     * CREATE / UPDATE
     * Membuat biodata baru jika belum ada, atau memperbarui jika sudah ada.
     */
    public function store(Request $request)
    {
        // Mengambil data yang ada, atau membuat instance baru jika kosong.
        $biodata = Biodata::firstOrNew();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'bio_singkat'  => 'required|string|max:500',
            // Validasi email unik, kecuali untuk data itu sendiri.
            'email'        => 'required|email|unique:biodatas,email,' . ($biodata->id ?? 'NULL') . ',id',
            'foto_profil'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dataToUpdate = $request->only(['nama_lengkap', 'bio_singkat', 'email']);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($biodata->foto_profil) {
                Storage::disk('public')->delete($biodata->foto_profil);
            }
            // Simpan foto baru
            $dataToUpdate['foto_profil'] = $request->file('foto_profil')->store('profile_photos', 'public');
        }

        // Mengisi data dan menyimpannya (baik itu record baru maupun update)
        $biodata->fill($dataToUpdate)->save();

        return response()->json($this->format($biodata), 200); // 200 OK
    }

    /**
     * Helper function untuk memformat output JSON secara konsisten.
     */
    private function format(Biodata $biodata)
    {
        return [
            'nama_lengkap'    => $biodata->nama_lengkap,
            'bio_singkat'     => $biodata->bio_singkat,
            'email'           => $biodata->email,
            'foto_profil_url' => $biodata->foto_profil ? asset('storage/' . $biodata->foto_profil) : null,
        ];
    }
}
