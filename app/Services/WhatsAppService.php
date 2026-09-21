<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Standarisasi nomor HP ke format 62xxx
     */
    public static function formatPhone(string $phone): string
    {
        $clean = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($clean, '0')) {
            return '62' . substr($clean, 1);
        }
        if (str_starts_with($clean, '8')) {
            return '62' . $clean;
        }
        return $clean;
    }

    /**
     * Kirim pesan WhatsApp melalui provider API (Fonnte / Wablas / Generic Gateway)
     * atau fallback ke Laravel Log jika API Token belum dikonfigurasi.
     */
    public static function sendMessage(string $recipientPhone, string $message): bool
    {
        $target = self::formatPhone($recipientPhone);
        $provider = Setting::get('whatsapp_provider', 'fonnte');
        $token = Setting::get('whatsapp_api_token', env('WHATSAPP_API_TOKEN', ''));
        $apiUrl = Setting::get('whatsapp_api_url', env('WHATSAPP_API_URL', ''));

        // Catat di log sistem untuk audit trail
        Log::info("WhatsApp Outgoing [{$target}]:\n" . $message);

        if (empty($token)) {
            // Belum ada token API aktif, log saja sebagai mock/sukses
            return true;
        }

        try {
            if ($provider === 'fonnte') {
                $endpoint = $apiUrl ?: 'https://api.fonnte.com/send';
                $response = Http::withHeaders([
                    'Authorization' => $token,
                ])->asForm()->post($endpoint, [
                    'target' => $target,
                    'message' => $message,
                ]);

                return $response->successful();
            }

            if ($provider === 'wablas') {
                $endpoint = $apiUrl ?: 'https://jogja.wablas.com/api/send-message';
                $response = Http::withHeaders([
                    'Authorization' => $token,
                ])->post($endpoint, [
                    'phone' => $target,
                    'message' => $message,
                ]);

                return $response->successful();
            }

            // Generic POST
            if (!empty($apiUrl)) {
                $response = Http::withToken($token)->post($apiUrl, [
                    'phone' => $target,
                    'message' => $message,
                ]);
                return $response->successful();
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('WhatsApp Gateway Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * TRIGGER 1: Saat Booking Dibuat (Pending Payment DP)
     * Kirim rincian booking, nomor rekening tujuan, nominal DP, dan link instruksi.
     */
    public static function sendPendingBookingNotice(Reservation $reservation): bool
    {
        $dateFormatted = $reservation->event_date ? $reservation->event_date->translatedFormat('d F Y') : '-';
        $dpFormatted = 'Rp ' . number_format($reservation->dp_amount, 0, ',', '.');
        $totalFormatted = 'Rp ' . number_format($reservation->package_price, 0, ',', '.');
        $remainingFormatted = 'Rp ' . number_format($reservation->remaining_amount, 0, ',', '.');

        $bcaAcc = Setting::get('bank_account_number_1', '8465-123-456');
        $bcaHolder = Setting::get('bank_account_holder_1', 'Rumah Joglo Omah Ayem');
        $mandiriAcc = Setting::get('bank_account_number_2', '137-00-1234567-8');
        $mandiriHolder = Setting::get('bank_account_holder_2', 'Rumah Joglo Omah Ayem');

        $invoiceUrl = route('booking.instruction', ['booking_code' => $reservation->booking_code]);

        $message = "Halo Kak *{$reservation->name}*,\n\n"
                 . "Terima kasih telah mengajukan reservasi di *Rumah Joglo Omah Ayem*.\n"
                 . "Berikut rincian pengajuan acara Anda:\n\n"
                 . "📌 *Kode Booking:* `{$reservation->booking_code}`\n"
                 . "📅 *Tanggal Acara:* {$dateFormatted}\n"
                 . "🏛️ *Pilihan Paket:* {$reservation->package_name}\n"
                 . "👥 *Estimasi Tamu:* {$reservation->guest_count}\n"
                 . "💰 *Total Biaya Sewa:* {$totalFormatted}\n"
                 . "💳 *Nominal Uang Muka (DP {$reservation->dp_percentage}%):* *{$dpFormatted}*\n"
                 . "💵 *Sisa Pelunasan:* {$remainingFormatted} (Maks. H-14)\n\n"
                 . "-------------------------------------\n"
                 . "Silakan lakukan transfer Uang Muka (DP) ke rekening resmi kami:\n"
                 . "🏦 *Bank BCA:* `{$bcaAcc}`\n"
                 . "   a.n. {$bcaHolder}\n\n"
                 . "🏦 *Bank Mandiri:* `{$mandiriAcc}`\n"
                 . "   a.n. {$mandiriHolder}\n"
                 . "-------------------------------------\n\n"
                 . "Lihat instruksi lengkap dan upload bukti transfer di sini:\n"
                 . "🔗 {$invoiceUrl}\n\n"
                 . "Setelah transfer, Anda dapat mengonfirmasi melalui link di atas atau membalas pesan ini dengan melampirkan bukti transfer.\n\n"
                 . "Salam hangat,\n*Pengelola Rumah Joglo Omah Ayem*";

        return self::sendMessage($reservation->phone, $message);
    }

    /**
     * TRIGGER 2: Saat Pembayaran DP Berhasil / Dikonfirmasi Admin
     * Kirim bukti resmi penerimaan DP dan konfirmasi penguncian tanggal acara.
     */
    public static function sendPaymentConfirmedNotice(Reservation $reservation): bool
    {
        $dateFormatted = $reservation->event_date ? $reservation->event_date->translatedFormat('d F Y') : '-';
        $dpFormatted = 'Rp ' . number_format($reservation->dp_amount, 0, ',', '.');
        $remainingFormatted = 'Rp ' . number_format($reservation->remaining_amount, 0, ',', '.');

        $message = "✨ *KONFIRMASI RESMI PEMBAYARAN DP* ✨\n"
                 . "Rumah Joglo Omah Ayem\n\n"
                 . "Halo Kak *{$reservation->name}*,\n"
                 . "Alhamdulillah, pembayaran Uang Muka (DP) untuk acara Anda telah kami terima dan verifikasi dengan rincian:\n\n"
                 . "🔖 *No. Invoice/Booking:* `{$reservation->booking_code}`\n"
                 . "📅 *Tanggal Acara Terkunci:* *{$dateFormatted}*\n"
                 . "🏛️ *Paket:* {$reservation->package_name}\n"
                 . "💵 *Nominal DP Diterima:* *{$dpFormatted}* (LUNAS DP)\n"
                 . "⏳ *Sisa Tagihan Pelunasan:* {$remainingFormatted} (Jatuh tempo H-14)\n"
                 . "🏷️ *Status Jadwal:* *DISAHKAN & TERKUNCI (CONFIRMED)*\n\n"
                 . "Tanggal acara Anda telah aman dan tidak dapat dipesan oleh pihak lain. Untuk jadwal survei lokasi dan koordinasi teknis vendor, silakan hubungi tim pengelola kami kapan saja.\n\n"
                 . "Terima kasih atas kepercayaan Anda merayakan momen istimewa bersama Rumah Joglo Omah Ayem.\n\n"
                 . "Salam hangat,\n*Tim Rumah Joglo Omah Ayem*";

        return self::sendMessage($reservation->phone, $message);
    }

    /**
     * TRIGGER 3: Notifikasi Otomatis ke WhatsApp Admin
     * Beritahukan ada booking baru yang masuk dan perlu dipantau pembayarannya.
     */
    public static function sendAdminNewBookingAlert(Reservation $reservation): bool
    {
        $adminPhone = Setting::getWhatsAppNumber('6281234567890');
        $dateFormatted = $reservation->event_date ? $reservation->event_date->translatedFormat('d F Y') : '-';
        $dpFormatted = 'Rp ' . number_format($reservation->dp_amount, 0, ',', '.');

        $message = "🚨 *NOTIFIKASI RESERVASI BARU MASUK* 🚨\n\n"
                 . "Terdapat pengajuan booking baru di website Omah Ayem:\n\n"
                 . "👤 *Pemesan:* {$reservation->name}\n"
                 . "📱 *WhatsApp:* {$reservation->phone}\n"
                 . "📅 *Tanggal Acara:* {$dateFormatted}\n"
                 . "🏛️ *Paket:* {$reservation->package_name}\n"
                 . "💰 *Uang Muka (DP):* {$dpFormatted}\n"
                 . "🔖 *Kode Booking:* `{$reservation->booking_code}`\n"
                 . "📝 *Catatan:* " . ($reservation->notes ?: '-') . "\n\n"
                 . "Silakan cek Admin Panel untuk verifikasi mutasi jika bukti transfer sudah dikirimkan pemesan:\n"
                 . route('admin.reservations.index', ['search' => $reservation->booking_code]);

        return self::sendMessage($adminPhone, $message);
    }
}

