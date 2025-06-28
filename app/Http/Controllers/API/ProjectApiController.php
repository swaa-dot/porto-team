<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectApiController extends Controller
{
    public function index()
    {
        return response()->json($this->formatCollection(Project::latest()->get()));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_projek'   => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'gambar_projek' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link_projek'   => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $request->file('gambar_projek')->store('project_images', 'public');

        $project = Project::create([
            'nama_projek' => $request->nama_projek,
            'deskripsi' => $request->deskripsi,
            'gambar_projek' => $imagePath,
            'link_projek' => $request->link_projek,
        ]);

        return response()->json($this->format($project), 201);
    }

    public function show(Project $project)
    {
        return response()->json($this->format($project));
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'nama_projek' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_projek' => 'nullable|url',
            'gambar_projek' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('gambar_projek')) {
            // Hapus gambar lama
            if ($project->gambar_projek) {
                Storage::disk('public')->delete($project->gambar_projek);
            }
            $imagePath = $request->file('gambar_projek')->store('project_images', 'public');
            $project->gambar_projek = $imagePath;
        }

        $project->nama_projek = $request->nama_projek;
        $project->deskripsi = $request->deskripsi;
        $project->link_projek = $request->link_projek;
        $project->save();

        return response()->json($this->format($project));
    }

    public function destroy(Project $project)
    {
        if ($project->gambar_projek) {
            Storage::disk('public')->delete($project->gambar_projek);
        }

        $project->delete();

        return response()->json(['message' => 'Project berhasil dihapus.']);
    }

    private function format(Project $project)
    {
        return [
            'id' => $project->id,
            'nama_projek' => $project->nama_projek,
            'deskripsi' => $project->deskripsi,
            'link_projek' => $project->link_projek,
            'gambar_url' => $project->gambar_projek ? asset(Storage::url($project->gambar_projek)) : null,
            'tanggal_dibuat' => $project->created_at->format('d F Y'),
        ];
    }

    private function formatCollection($projects)
    {
        return $projects->map(fn($project) => $this->format($project));
    }
}
