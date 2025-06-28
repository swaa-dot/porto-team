<?php

namespace App\Http\Controllers;

use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $experiences = WorkExperience::latest()->get();
        return view('work_experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('work_experiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        WorkExperience::create($request->all());

        return redirect()->route('work-experiences.index')->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    public function edit(WorkExperience $workExperience)
    {
        return view('work_experiences.edit', compact('workExperience'));
    }

    public function update(Request $request, WorkExperience $workExperience)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $workExperience->update($request->all());

        return redirect()->route('work-experiences.index')->with('success', 'Pengalaman kerja berhasil diperbarui.');
    }

    public function destroy(WorkExperience $workExperience)
    {
        $workExperience->delete();
        return redirect()->route('work-experiences.index')->with('success', 'Pengalaman kerja berhasil dihapus.');
    }
}
