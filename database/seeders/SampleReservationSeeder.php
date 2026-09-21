<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SampleReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Sample Reservasi
        $reservations = [
            [
                'name' => 'Bagas Prasetyo & Dewi Anggraeni',
                'phone' => '081298765432',
                'email' => 'bagas.prasetyo@example.com',
                'event_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'package_name' => 'Paket Pernikahan Gayatri (Full Venue)',
                'guest_count' => '300 - 450 Tamu (Grand Wedding)',
                'notes' => 'Membutuhkan akses loading vendor H-1 malam untuk dekorasi adat Jawa gebyok.',
                'status' => 'pending',
                'admin_notes' => 'Menunggu jadwal survei lokasi hari Sabtu ini.',
            ],
            [
                'name' => 'PT Nusantara Graha Mandiri (Bpk. Bambang)',
                'phone' => '081387654321',
                'email' => 'event@nusantaragraha.co.id',
                'event_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'package_name' => 'Paket Gathering Omah Tentrem',
                'guest_count' => '50 - 150 Tamu (Intimate Event / Lamaran)',
                'notes' => 'Gathering keluarga direksi & gala dinner santai bernuansa tradisional.',
                'status' => 'confirmed',
                'admin_notes' => 'DP 50% sudah diterima, katering prasmanan tradisional dipesan.',
            ],
            [
                'name' => 'Studio Foto Kencana (Mbak Siska)',
                'phone' => '087812345678',
                'email' => 'siska.kencana@example.com',
                'event_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'package_name' => 'Paket Photoshoot & Prewedding Kencana',
                'guest_count' => 'Kurang dari 50 Tamu (Sangat Intim / Photoshoot)',
                'notes' => 'Sesi foto prewedding adat Solo basahan, durasi 6 jam siang ke sore.',
                'status' => 'confirmed',
                'admin_notes' => 'Jadwal pukul 10.00 - 16.00 WIB.',
            ],
            [
                'name' => 'Raden Mas Suryo Putro',
                'phone' => '081567890123',
                'email' => 'suryo.putro@example.com',
                'event_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'package_name' => 'Paket Akad & Resepsi Intimate Wilwatikta',
                'guest_count' => '150 - 300 Tamu (Resepsi Sedang)',
                'notes' => 'Acara temu manten dan siraman keluarga besar.',
                'status' => 'completed',
                'admin_notes' => 'Acara sukses berjalan lancar, pelunasan selesai.',
            ],
            [
                'name' => 'Keluarga Besar Cokroaminoto',
                'phone' => '081909876543',
                'email' => 'cokro.family@example.com',
                'event_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'package_name' => 'Paket Gathering Omah Tentrem',
                'guest_count' => '50 - 150 Tamu (Intimate Event / Lamaran)',
                'notes' => 'Reuni akbar trah keluarga besar.',
                'status' => 'pending',
                'admin_notes' => null,
            ],
        ];

        foreach ($reservations as $res) {
            Reservation::updateOrCreate(
                ['phone' => $res['phone'], 'event_date' => $res['event_date']],
                $res
            );
        }

        // 2. Sample Foto Galeri
        $galleries = [
            [
                'title' => 'Kemegahan Pendopo Utama Kayu Jati Tua',
                'category' => 'Pendopo',
                'image_path' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Ukiran tumpangsari khas Joglo Jawa kuno dengan pencahayaan temaram hangat.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Dekorasi Meja Jamuan Adat Elegan',
                'category' => 'Acara & Dekorasi',
                'image_path' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Penataan meja makan panjang untuk jamuan makan malam intim para tamu undangan.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Taman Asri & Halaman Rumput Outdoor',
                'category' => 'Taman & Outdoor',
                'image_path' => 'https://images.unsplash.com/photo-1588880331179-bc9b93a8cb5e?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Pohon rindang, rumput hijau, dan udara sejuk ideal untuk pesta kebun senja.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Suasana Malam Gemerlap Lampu Antik',
                'category' => 'Pendopo',
                'image_path' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Lentera dan lampu gantung klasik memberikan atmosfer romantis dan syahdu.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Kamar Rias & Transit Pengantin',
                'category' => 'Kamar & Penginapan',
                'image_path' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1200&q=80',
                'caption' => 'Ruang rias privat dengan pendingin ruangan dan cermin rias berukuran besar.',
                'sort_order' => 5,
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(
                ['title' => $gal['title']],
                $gal
            );
        }
    }
}

