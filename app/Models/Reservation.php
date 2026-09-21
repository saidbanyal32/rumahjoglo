<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'name',
        'phone',
        'email',
        'event_date',
        'package_name',
        'package_price',
        'dp_percentage',
        'dp_amount',
        'remaining_amount',
        'guest_count',
        'notes',
        'status',
        'payment_status',
        'payment_method',
        'payment_proof',
        'admin_notes',
    ];

    protected $casts = [
        'event_date' => 'date',
        'package_price' => 'integer',
        'dp_percentage' => 'integer',
        'dp_amount' => 'integer',
        'remaining_amount' => 'integer',
    ];

    /**
     * Cek apakah tanggal acara sudah dipesan (Double Booking Protection)
     */
    public static function isDateBooked(string $date, ?int $excludeId = null): bool
    {
        $query = static::whereDate('event_date', $date)
            ->whereIn('status', ['confirmed', 'completed']);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    /**
     * Label status pemesanan bahasa Indonesia
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending_payment' => 'Menunggu Pembayaran DP',
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Terkonfirmasi (DP Diterima)',
            'completed' => 'Selesai Dilaksanakan',
            'cancelled' => 'Dibatalkan',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    /**
     * Style badge warna Tailwind untuk status pemesanan
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending_payment' => 'bg-amber-100 text-amber-800 border-amber-300',
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'confirmed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'completed' => 'bg-blue-100 text-blue-800 border-blue-300',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }

    /**
     * Label status pembayaran DP
     */
    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'unpaid' => 'Belum Dibayar',
            'paid' => 'DP Lunas',
            'cancelled' => 'Batal',
            default => ucfirst($this->payment_status),
        };
    }

    /**
     * Style badge warna Tailwind untuk status pembayaran
     */
    public function getPaymentStatusBadgeAttribute(): string
    {
        return match ($this->payment_status) {
            'unpaid' => 'bg-rose-100 text-rose-800 border-rose-200',
            'paid' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            'cancelled' => 'bg-stone-100 text-stone-700 border-stone-200',
            default => 'bg-stone-100 text-stone-700 border-stone-200',
        };
    }

    /**
     * Format Rupiah untuk Total Nilai Paket
     */
    public function getFormattedPackagePriceAttribute(): string
    {
        return 'Rp ' . number_format($this->package_price, 0, ',', '.');
    }

    /**
     * Format Rupiah untuk Nominal DP
     */
    public function getFormattedDpAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->dp_amount, 0, ',', '.');
    }

    /**
     * Format Rupiah untuk Sisa Pelunasan
     */
    public function getFormattedRemainingAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->remaining_amount, 0, ',', '.');
    }

    /**
     * URL file bukti pembayaran
     */
    public function getPaymentProofUrlAttribute(): ?string
    {
        if (!$this->payment_proof) {
            return null;
        }

        if (str_starts_with($this->payment_proof, 'http://') || str_starts_with($this->payment_proof, 'https://')) {
            return $this->payment_proof;
        }

        return Storage::disk('public')->url($this->payment_proof);
    }

    /**
     * Generate URL WhatsApp untuk chat konfirmasi langsung dari admin ke pemesan
     */
    public function getWhatsAppUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string)$this->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        $formattedDate = $this->event_date ? $this->event_date->translatedFormat('d F Y') : '-';

        $text = "Halo Kak {$this->name},\n\n"
              . "Terima kasih telah mengajukan reservasi di *Rumah Joglo Omah Ayem* (Kode: `{$this->booking_code}`).\n"
              . "Rencana Acara: *{$formattedDate}* - Paket *{$this->package_name}*.\n\n"
              . "Apakah ada kendala mengenai pembayaran Uang Muka (DP) atau ada hal yang ingin didiskusikan dengan tim kami?\n\n"
              . "Salam hangat,\n*Pengelola Rumah Joglo Omah Ayem*";

        return "https://wa.me/{$phone}?text=" . rawurlencode($text);
    }

    /**
     * Generate URL WhatsApp bagi pemesan untuk konfirmasi bukti transfer ke WhatsApp Admin
     */
    public function getCustomerConfirmWhatsAppUrlAttribute(): string
    {
        $adminPhone = Setting::getWhatsAppNumber('6281234567890');
        $formattedDate = $this->event_date ? $this->event_date->translatedFormat('d F Y') : '-';
        $dpFormatted = $this->formatted_dp_amount;

        $text = "Halo Admin *Rumah Joglo Omah Ayem*,\n\n"
              . "Saya ingin mengonfirmasi bahwa saya sudah melakukan transfer Uang Muka (DP) untuk reservasi berikut:\n\n"
              . "🔖 *Kode Booking:* `{$this->booking_code}`\n"
              . "👤 *Nama Pemesan:* {$this->name}\n"
              . "📅 *Tanggal Acara:* {$formattedDate}\n"
              . "🏛️ *Paket:* {$this->package_name}\n"
              . "💰 *Nominal DP:* {$dpFormatted}\n\n"
              . "Mohon diverifikasi dan dikonfirmasi ketersediaan jadwalnya. Bukti transfer saya lampirkan bersama pesan ini. Terima kasih!";

        return "https://wa.me/{$adminPhone}?text=" . rawurlencode($text);
    }
}
