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
            'dp_percentage' => ['nullable', 'integer', 'min:10', 'max:100'],
            'bank_name_1' => ['nullable', 'string', 'max:50'],
            'bank_account_number_1' => ['nullable', 'string', 'max:50'],
            'bank_account_holder_1' => ['nullable', 'string', 'max:100'],
            'bank_name_2' => ['nullable', 'string', 'max:50'],
            'bank_account_number_2' => ['nullable', 'string', 'max:50'],
            'bank_account_holder_2' => ['nullable', 'string', 'max:100'],
            'payment_instructions' => ['nullable', 'string', 'max:1000'],
            'whatsapp_provider' => ['nullable', 'string', 'max:50'],
            'whatsapp_api_token' => ['nullable', 'string', 'max:255'],
            'whatsapp_api_url' => ['nullable', 'string', 'max:255'],
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
            'dp_percentage' => 'payment',
            'bank_name_1' => 'payment',
            'bank_account_number_1' => 'payment',
            'bank_account_holder_1' => 'payment',
            'bank_name_2' => 'payment',
            'bank_account_number_2' => 'payment',
            'bank_account_holder_2' => 'payment',
            'payment_instructions' => 'payment',
            'whatsapp_provider' => 'notification',
            'whatsapp_api_token' => 'notification',
            'whatsapp_api_url' => 'notification',
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
            ->with('success', 'Konfigurasi website dan rekening pembayaran berhasil disimpan.');
    }
}
