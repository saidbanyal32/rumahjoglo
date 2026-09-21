<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Tampilkan grid galeri foto dan form upload.
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');

        $query = Gallery::query()->orderBy('sort_order', 'asc')->latest();

        if ($category !== 'all' && array_key_exists($category, Gallery::CATEGORIES)) {
            $query->where('category', $category);
        }

        $galleries = $query->paginate(12)->withQueryString();
        $categories = Gallery::CATEGORIES;

        return view('admin.gallery.index', compact('galleries', 'category', 'categories'));
    }

    /**
     * Upload dan simpan foto galeri baru ke storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(Gallery::CATEGORIES))],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // Max 5MB
            'caption' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ], [
            'title.required' => 'Judul foto wajib diisi.',
            'image.required' => 'File foto wajib dipilih.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WebP.',
            'image.max' => 'Ukuran gambar maksimal adalah 5MB.',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'image_path' => $path,
            'caption' => $request->input('caption'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri baru berhasil diunggah dan disimpan.');
    }

    /**
     * Hapus foto galeri dan file fisik di storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik dari storage jika bukan URL eksternal
        if (!str_starts_with($gallery->image_path, 'http://') && !str_starts_with($gallery->image_path, 'https://')) {
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
        }

        $title = $gallery->title;
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', "Foto '{$title}' berhasil dihapus.");
    }
}

