<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Tampilkan daftar reservasi lengkap dengan filter status & pencarian.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = Reservation::query()->latest();

        if ($status !== 'all') {
            if ($status === 'pending') {
                $query->whereIn('status', ['pending', 'pending_payment']);
            } elseif (in_array($status, ['confirmed', 'completed', 'cancelled', 'pending_payment'])) {
                $query->where('status', $status);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('package_name', 'like', "%{$search}%")
                  ->orWhere('booking_code', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reservations = $query->paginate(15)->withQueryString();

        // Hitung badge counter per status
        $counts = [
            'all' => Reservation::count(),
            'pending' => Reservation::whereIn('status', ['pending', 'pending_payment'])->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'completed' => Reservation::where('status', 'completed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];

        return view('admin.reservations.index', compact('reservations', 'status', 'search', 'counts'));
    }

    /**
     * Update status dan catatan admin untuk reservasi.
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,pending_payment,confirmed,completed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $oldStatus = $reservation->status;
        $reservation->update($validated);

        // Jika diubah menjadi confirmed, update payment_status dan kirim notifikasi WA (Trigger 2)
        if ($validated['status'] === 'confirmed' && $oldStatus !== 'confirmed') {
            $reservation->update(['payment_status' => 'paid']);
            WhatsAppService::sendPaymentConfirmedNotice($reservation);
        }

        return redirect()->back()->with('success', "Status reservasi {$reservation->name} berhasil diperbarui menjadi {$reservation->status_label}.");
    }

    /**
     * Konfirmasi Pembayaran Uang Muka (DP) & Kirim Resi Resmi via WhatsApp
     */
    public function confirmPayment(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'admin_notes' => ($reservation->admin_notes ? $reservation->admin_notes . "\n" : '') . 'Pembayaran DP telah diverifikasi oleh admin pada ' . now()->translatedFormat('d M Y H:i') . ' WIB.'
        ]);

        // Trigger WhatsApp 2
        WhatsAppService::sendPaymentConfirmedNotice($reservation);

        return redirect()->back()->with('success', "Pembayaran DP untuk {$reservation->name} berhasil dikonfirmasi dan jadwal acara telah resmi terkunci!");
    }

    /**
     * Hapus data reservasi.
     */
    public function destroy(Reservation $reservation)
    {
        $name = $reservation->name;
        $reservation->delete();

        return redirect()->back()->with('success', "Data reservasi dari {$name} berhasil dihapus.");
    }
}
