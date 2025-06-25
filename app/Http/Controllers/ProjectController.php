<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(5);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_projek'   => 'required|string|min:3|max:255',
            'deskripsi'     => 'required|string|min:10',
            'gambar_projek' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link_projek'   => 'nullable|url'
        ]);

        // ✅ Upload gambar ke public disk tanpa "public/" di path
        $imagePath = $request->file('gambar_projek')->store('project_images', 'public');

        Project::create([
            'nama_projek'   => $validatedData['nama_projek'],
            'deskripsi'     => $validatedData['deskripsi'],
            'gambar_projek' => $imagePath,
            'link_projek'   => $validatedData['link_projek']
        ]);

        return redirect()->route('projects.index')->with(['success' => 'Project Baru Berhasil Disimpan!']);
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'nama_projek'   => 'required|string|min:3|max:255',
            'deskripsi'     => 'required|string|min:10',
            'gambar_projek' => 'image|mimes:jpeg,jpg,png|max:2048',
            'link_projek'   => 'nullable|url'
        ]);

        if ($request->hasFile('gambar_projek')) {
            // ✅ Upload ke disk 'public' tanpa prefix "public/"
            $imagePath = $request->file('gambar_projek')->store('project_images', 'public');

            // Hapus gambar lama
            Storage::disk('public')->delete($project->gambar_projek);

            $project->update([
                'nama_projek'   => $validatedData['nama_projek'],
                'deskripsi'     => $validatedData['deskripsi'],
                'gambar_projek' => $imagePath,
                'link_projek'   => $validatedData['link_projek']
            ]);
        } else {
            $project->update([
                'nama_projek'   => $validatedData['nama_projek'],
                'deskripsi'     => $validatedData['deskripsi'],
                'link_projek'   => $validatedData['link_projek']
            ]);
        }

        return redirect()->route('projects.index')->with(['success' => 'Data Project Berhasil Diperbarui!']);
    }

    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->gambar_projek);
        $project->delete();
        return redirect()->route('projects.index')->with(['success' => 'Data Project Berhasil Dihapus!']);
    }
}
