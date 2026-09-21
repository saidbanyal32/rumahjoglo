<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
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

        if ($status !== 'all' && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('package_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reservations = $query->paginate(15)->withQueryString();

        // Hitung badge counter per status
        $counts = [
            'all' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
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
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $reservation->update($validated);

        return redirect()->back()->with('success', "Status reservasi {$reservation->name} berhasil diperbarui menjadi {$reservation->status_label}.");
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

