<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Profil Umum
            ['key' => 'site_name', 'value' => 'Rumah Joglo Omah Ayem', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Keanggunan Tradisi Jawa untuk Momen Istimewa Anda', 'group' => 'general'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@omahayem.com', 'group' => 'general'],
            ['key' => 'address', 'value' => 'Jl. Anggajaya II No. 12, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283', 'group' => 'general'],
            ['key' => 'maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2872322304914!2d110.3955685!3d-7.7593259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a599bd85f67b5%3A0xb3a827727339d936!2sCondongcatur%2C%20Depok%2C%20Sleman%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid', 'group' => 'general'],

            // Sosial Media
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/omahayem.joglo', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@omahayem.joglo', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/omahayem.joglo', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@omahayem', 'group' => 'social'],

            // Pengaturan Rekening Bank & Pembayaran DP
            ['key' => 'dp_percentage', 'value' => '30', 'group' => 'payment'],
            ['key' => 'bank_name_1', 'value' => 'BCA', 'group' => 'payment'],
            ['key' => 'bank_account_number_1', 'value' => '8465-123-456', 'group' => 'payment'],
            ['key' => 'bank_account_holder_1', 'value' => 'Rumah Joglo Omah Ayem', 'group' => 'payment'],
            ['key' => 'bank_name_2', 'value' => 'Bank Mandiri', 'group' => 'payment'],
            ['key' => 'bank_account_number_2', 'value' => '137-00-1234567-8', 'group' => 'payment'],
            ['key' => 'bank_account_holder_2', 'value' => 'Rumah Joglo Omah Ayem', 'group' => 'payment'],
            ['key' => 'payment_instructions', 'value' => 'Silakan lakukan transfer Uang Muka (DP) ke rekening resmi kami di atas dan sertakan Kode Booking pada berita transfer. Jadwal acara resmi terkunci setelah pembayaran DP diverifikasi.', 'group' => 'payment'],

            // Hero & Beranda
            ['key' => 'hero_headline', 'value' => 'Pesona Otentik Joglo Kayu Jati Kuno untuk Momen Sakral dan Bersejarah', 'group' => 'hero'],
            ['key' => 'hero_subheadline', 'value' => 'Tempat sewa eksklusif bernuansa klasik Jawa di Condongcatur, Yogyakarta. Suasana asri nan damai untuk pernikahan adat, gathering keluarga, dan photoshoot privat.', 'group' => 'hero'],
            ['key' => 'hero_image', 'value' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1920&q=80', 'group' => 'hero'],
        ];

        foreach ($settings as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'], 'group' => $item['group']]
            );
        }
    }
}

