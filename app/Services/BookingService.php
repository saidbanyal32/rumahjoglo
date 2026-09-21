<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Setting;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Ambil katalog paket sewa resmi
     */
    public static function getPackages(): array
    {
        return config('packages.items', []);
    }

    /**
     * Cari detail paket berdasarkan nama atau ID
     */
    public static function findPackage(string $identifier): ?array
    {
        $packages = self::getPackages();
        foreach ($packages as $pkg) {
            if ($pkg['id'] === $identifier || $pkg['name'] === $identifier || $pkg['slug'] === $identifier) {
                return $pkg;
            }
        }
        return null;
    }

    /**
     * Hitung kalkulasi nominal DP dan sisa pelunasan
     */
    public static function calculateDp(int $packagePrice, ?int $dpPercentage = null): array
    {
        $percentage = $dpPercentage ?? (int) Setting::get('dp_percentage', 30);
        $percentage = max(10, min(100, $percentage)); // Batasan 10% - 100%

        $dpAmount = (int) round(($packagePrice * $percentage) / 100);
        $remainingAmount = max(0, $packagePrice - $dpAmount);

        return [
            'package_price' => $packagePrice,
            'dp_percentage' => $percentage,
            'dp_amount' => $dpAmount,
            'remaining_amount' => $remainingAmount,
        ];
    }

    /**
     * Generate Kode Booking Unik
     */
    public static function generateBookingCode(): string
    {
        do {
            $code = 'OAYEM-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Reservation::where('booking_code', $code)->exists());

        return $code;
    }

    /**
     * Cek apakah tanggal tersedia atau bentrok dengan acara lain
     */
    public static function checkDate(string $date, ?int $excludeId = null): array
    {
        $isBooked = Reservation::isDateBooked($date, $excludeId);

        if ($isBooked) {
            return [
                'available' => false,
                'message' => 'Tanggal ini telah dipesan dan terkunci untuk acara lain. Silakan pilih tanggal alternatif.',
            ];
        }

        // Cek juga jika ada yang berstatus pending_payment dalam 6 jam terakhir
        $hasPending = Reservation::whereDate('event_date', $date)
            ->where('status', 'pending_payment')
            ->where('created_at', '>=', now()->subHours(6))
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->exists();

        if ($hasPending) {
            return [
                'available' => true,
                'has_pending' => true,
                'message' => 'Tanggal ini sedang dalam proses verifikasi pembayaran DP oleh calon penyewa lain. Anda tetap dapat mengajukan inquiry atau konsultasi langsung via WhatsApp.',
            ];
        }

        return [
            'available' => true,
            'has_pending' => false,
            'message' => 'Tanggal ini masih tersedia. Segera ajukan reservasi untuk mengunci jadwal acara Anda!',
        ];
    }
}
