<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Reservation;

class DashboardController extends Controller
{
    /**
     * Tampilkan overview dashboard admin beserta kartu ringkasan & 5 reservasi terbaru.
     */
    public function index()
    {
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $confirmedReservations = Reservation::where('status', 'confirmed')->count();
        $totalGalleries = Gallery::count();

        $latestReservations = Reservation::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalReservations',
            'pendingReservations',
            'confirmedReservations',
            'totalGalleries',
            'latestReservations'
        ));
    }
}

