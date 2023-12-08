<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $suratMasukData = SuratMasuk::selectRaw('COUNT(*) as count, MONTHNAME(tanggal_diterima) as month_name')
            ->whereYear('tanggal_diterima', $currentYear)
            ->groupBy('month_name')
            ->orderByRaw('MONTH(tanggal_diterima)')
            ->pluck('count', 'month_name')
            ->toArray();

        $suratKeluarData = SuratKeluar::selectRaw('COUNT(*) as count, MONTHNAME(tanggal_keluar) as month_name')
            ->whereYear('tanggal_keluar', $currentYear)
            ->groupBy('month_name')
            ->orderByRaw('MONTH(tanggal_keluar)')
            ->pluck('count', 'month_name')
            ->toArray();

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $labels = [];
        $dataSuratMasuk = [];
        $dataSuratKeluar = [];

        foreach ($months as $month) {
            $labels[] = $month;
            $dataSuratMasuk[] = $suratMasukData[$month] ?? 0;
            $dataSuratKeluar[] = $suratKeluarData[$month] ?? 0;
        }

        $totalSuratMasukBulan = SuratMasuk::whereYear('tanggal_diterima', $currentYear)->count();
        $totalSuratKeluarBulan = SuratKeluar::whereYear('tanggal_keluar', $currentYear)->count();

        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();

        $totalSuratMasukBulanIni = SuratMasuk::whereYear('tanggal_diterima', $currentYear)
            ->whereMonth('tanggal_diterima', $currentMonth)
            ->count();

        $totalSuratKeluarBulanIni = SuratKeluar::whereYear('tanggal_keluar', $currentYear)
            ->whereMonth('tanggal_keluar', $currentMonth)
            ->count();

        $totalSuratBulanIni = $totalSuratMasukBulanIni + $totalSuratKeluarBulanIni;

        $totalSuratTahunIni = $totalSuratMasukBulan + $totalSuratKeluarBulan;

        return view('dashboard.index', compact(
            'labels',
            'dataSuratMasuk',
            'dataSuratKeluar',
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalSuratMasukBulanIni',
            'totalSuratKeluarBulanIni',
            'totalSuratBulanIni',
            'totalSuratTahunIni'
        ));
    }
}
