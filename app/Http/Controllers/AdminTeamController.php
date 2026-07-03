<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'skills' => 'nullable|string|max:255',
            'certificate' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'description' => 'nullable|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'integer',
        ]);

        if ($request->hasFile('photo_path')) {
            $path = $request->file('photo_path')->store('team', 'public');
            $validated['photo_path'] = $path;
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'skills' => 'nullable|string|max:255',
            'certificate' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'description' => 'nullable|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'integer',
        ]);

        if ($request->hasFile('photo_path')) {
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $path = $request->file('photo_path')->store('team', 'public');
            $validated['photo_path'] = $path;
        }

        $member->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);
        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }
        $member->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
