<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'testimonial' => 'required|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'is_approved' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        if ($request->hasFile('photo_path')) {
            $path = $request->file('photo_path')->store('testimonials', 'public');
            $validated['photo_path'] = $path;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'testimonial' => 'required|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'is_approved' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        if ($request->hasFile('photo_path')) {
            if ($testimonial->photo_path) {
                Storage::disk('public')->delete($testimonial->photo_path);
            }
            $path = $request->file('photo_path')->store('testimonials', 'public');
            $validated['photo_path'] = $path;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->photo_path) {
            Storage::disk('public')->delete($testimonial->photo_path);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
