<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'event_date',
        'package_name',
        'guest_count',
        'notes',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Label status bahasa Indonesia yang rapi.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Disetujui / Terkonfirmasi',
            'completed' => 'Selesai Dilaksanakan',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    /**
     * Style badge warna Tailwind untuk status.
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'confirmed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'completed' => 'bg-blue-100 text-blue-800 border-blue-300',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }

    /**
     * Generate URL WhatsApp untuk chat konfirmasi langsung ke pemesan.
     */
    public function getWhatsAppUrlAttribute(): string
    {
        // Standarisasi nomor HP ke format internasional (62xxx)
        $phone = preg_replace('/[^0-9]/', '', (string)$this->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        $formattedDate = $this->event_date ? $this->event_date->translatedFormat('d F Y') : '-';

        $text = "Halo Kak {$this->name},\n\n"
              . "Terima kasih telah menghubungi pengelola *Rumah Joglo Omah Ayem* mengenai rencana acara Anda pada tanggal *{$formattedDate}* untuk paket *{$this->package_name}*.\n\n"
              . "Kami ingin mengonfirmasi detail reservasi dan mengatur jadwal survei lokasi bila berkenan. Apakah ada hal khusus yang ingin didiskusikan lebih lanjut?\n\n"
              . "Salam hangat,\n*Tim Pengelola Rumah Joglo Omah Ayem*";

        return "https://wa.me/{$phone}?text=" . rawurlencode($text);
    }
}

