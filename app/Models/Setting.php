<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Ambil nilai pengaturan berdasarkan key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $setting = static::where('key', $key)->first();
            return $setting && $setting->value !== null ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Simpan atau update nilai pengaturan.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): self
    {
        Cache::forget('site_settings_all');

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Ambil nomor WhatsApp yang distandarisasi ke format internasional (62xxx).
     */
    public static function getWhatsAppNumber(string $default = '6281234567890'): string
    {
        $raw = static::get('contact_whatsapp', $default);
        $clean = preg_replace('/[^0-9]/', '', (string)$raw);
        if (str_starts_with($clean, '0')) {
            return '62' . substr($clean, 1);
        }
        if (str_starts_with($clean, '8')) {
            return '62' . $clean;
        }
        return $clean ?: $default;
    }

    /**
     * Buat URL WhatsApp wa.me dinamis dengan nomor dari pengaturan.
     */
    public static function getWhatsAppUrl(string $message = '', string $default = '6281234567890'): string
    {
        $number = static::getWhatsAppNumber($default);
        if (empty($message)) {
            $message = 'Halo Admin Rumah Joglo Omah Ayem, saya tertarik untuk menanyakan ketersediaan jadwal sewa tempat...';
        }
        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }
}

