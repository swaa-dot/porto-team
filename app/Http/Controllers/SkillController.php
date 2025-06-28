<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // Menampilkan semua skill ke halaman utama (public)
    public function index()
{
    $skills = Skill::all();
    return view('skills.index', compact('skills'));
}

public function create()
{
    return view('skills.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'level' => 'required|integer|min:0|max:100',
        'warna' => 'required|string',
        'ikon' => 'nullable|string', // Validasi untuk ikon
    ]);

    Skill::create($request->all());

    // Ubah redirect ke halaman home ('/')
    return redirect('/')
        ->with('success', 'Skill berhasil disimpan!');
}


public function edit(Skill $skill)
{
    return view('skills.edit', compact('skill'));
}

public function update(Request $request, Skill $skill)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'level' => 'required|integer|min:0|max:100',
        'warna' => 'required|string',
        'ikon' => 'nullable|string', // Validasi untuk ikon
    ]);

    $skill->update($request->all());

    return redirect()->route('skills.index')->with('success', 'Skill berhasil diperbarui!');
}

public function destroy(Skill $skill)
{
    $skill->delete();
    return redirect()->route('skills.index')->with('success', 'Skill berhasil dihapus!');
}
}