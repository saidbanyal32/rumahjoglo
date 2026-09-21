<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Tampilkan halaman pengaturan website dan profil umum.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Simpan pembaruan pengaturan website.
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'contact_whatsapp' => ['required', 'string', 'max:30'],
            'contact_email' => ['nullable', 'email', 'max:100'],
            'address' => ['nullable', 'string', 'max:500'],
            'maps_embed' => ['nullable', 'string'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_tiktok' => ['nullable', 'string', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_youtube' => ['nullable', 'string', 'max:255'],
            'hero_headline' => ['nullable', 'string', 'max:300'],
            'hero_subheadline' => ['nullable', 'string', 'max:500'],
            'hero_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $fields = [
            'site_name' => 'general',
            'tagline' => 'general',
            'contact_whatsapp' => 'general',
            'contact_email' => 'general',
            'address' => 'general',
            'maps_embed' => 'general',
            'social_instagram' => 'social',
            'social_tiktok' => 'social',
            'social_facebook' => 'social',
            'social_youtube' => 'social',
            'hero_headline' => 'hero',
            'hero_subheadline' => 'hero',
        ];

        foreach ($fields as $key => $group) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), $group);
            }
        }

        // Upload gambar hero banner baru jika ada
        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('banner', 'public');
            $url = Storage::url($path);
            Setting::set('hero_image', $url, 'hero');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Konfigurasi website berhasil disimpan dan diperbarui.');
    }
}

