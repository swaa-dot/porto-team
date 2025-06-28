<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::latest()->get();
        return view('educations.index', compact('educations'));
    }

    public function create()
    {
        return view('educations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun_mulai' => 'required|date',
            'tahun_selesai' => 'nullable|date|after_or_equal:tahun_mulai',
        ]);

        Education::create($request->all());

        return redirect()->route('educations.index')->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        return view('educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun_mulai' => 'required|date',
            'tahun_selesai' => 'nullable|date|after_or_equal:tahun_mulai',
        ]);

        $education->update($request->all());

        return redirect()->route('educations.index')->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('educations.index')->with('success', 'Data pendidikan berhasil dihapus.');
    }
}

