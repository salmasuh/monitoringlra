<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Skpd;
use App\Models\PjSkpd;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Semua Monitoring
        |--------------------------------------------------------------------------
        */

        $allMonitorings = Monitoring::with(['skpd', 'pjskpd'])
            ->orderBy('tanggal_update', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Buat Periode Mingguan
        |--------------------------------------------------------------------------
        */

        $periodeList = [];

        $grouped = $allMonitorings->groupBy(function ($item) {

            $tanggal = Carbon::parse($item->tanggal_update);

            return $tanggal->startOfWeek()->format('Y-m-d');
        });

        foreach ($grouped as $startWeek => $items) {

            $mulai = Carbon::parse($startWeek);

            $akhir = Carbon::parse($startWeek)->endOfWeek();

            $periodeList[] = [
                'value' => $startWeek,
                'label' => 'Minggu ' . $mulai->weekOfYear .
                    ' (' .
                    $mulai->format('d M') .
                    ' - ' .
                    $akhir->format('d M Y') .
                    ')',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Periode Dipilih
        |--------------------------------------------------------------------------
        */

        $selectedWeek = $request->periode;

        if (!$selectedWeek && count($periodeList) > 0) {
            $selectedWeek = $periodeList[0]['value'];
        }

        /*
        |--------------------------------------------------------------------------
        | Data Monitoring Per Minggu
        |--------------------------------------------------------------------------
        */

        $monitorings = Monitoring::with(['skpd', 'pjskpd'])

            ->when($selectedWeek, function ($query) use ($selectedWeek) {

                $start = Carbon::parse($selectedWeek)->startOfWeek();

                $end = Carbon::parse($selectedWeek)->endOfWeek();

                $query->whereBetween('tanggal_update', [$start, $end]);
            })

            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalSkpd = $monitorings
            ->pluck('skpd_id')
            ->unique()
            ->count();

        $selesai = $monitorings
            ->where('status', 'Sudah Selesai')
            ->count();

        $review = $monitorings
            ->where('status', 'Perlu Review')
            ->count();

        $belum = $monitorings
            ->where('status', 'Belum Update')
            ->count();

        $dalamProses = $monitorings
            ->where('status', 'Dalam Proses')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Progress Konsolidasi
        |--------------------------------------------------------------------------
        */

        $progress = 0;

        if ($totalSkpd > 0) {

            $progress = round(($selesai / $totalSkpd) * 100);
        }

        /*
        |--------------------------------------------------------------------------
        | Dropdown
        |--------------------------------------------------------------------------
        */

        $tahunList = $monitorings
            ->pluck('tanggal_update')
            ->map(function ($tanggal) {
                return Carbon::parse($tanggal)->year;
            })
            ->unique();

        $skpdList = $monitorings
            ->pluck('skpd.nama')
            ->unique();

        $pjList = $monitorings
            ->pluck('pjskpd.nama')
            ->unique();

        /*
        |--------------------------------------------------------------------------
        | Trend Mingguan
        |--------------------------------------------------------------------------
        */

        $trendLabels = [];
        $trendData = [];

        foreach ($grouped as $startWeek => $items) {

            $mulai = Carbon::parse($startWeek);

            $selesaiMinggu = $items
                ->where('status', 'Sudah Selesai')
                ->count();

            $totalMinggu = $items
                ->pluck('skpd_id')
                ->unique()
                ->count();

            $persentase = 0;

            if ($totalMinggu > 0) {

                $persentase = round(($selesaiMinggu / $totalMinggu) * 100);
            }

            $trendLabels[] = 'Minggu-' . $mulai->weekOfYear;

            $trendData[] = $persentase;
        }

        /*
        |--------------------------------------------------------------------------
        | Progress per PJ SKPD
        |--------------------------------------------------------------------------
        */

        $progressPj = [];

        $pjAll = PjSkpd::with('skpd')->get();

        foreach ($pjAll as $pj) {

            $jumlahMonitoring = $monitorings
                ->where('pj_skpd_id', $pj->id)
                ->count();

            $persen = 0;

            if ($totalSkpd > 0) {

                $persen = round(($jumlahMonitoring / $totalSkpd) * 100);
            }

            $progressPj[] = [
                'nama' => $pj->nama,
                'persen' => $persen,
            ];
        }

        return view('dashboard.index', compact(
            'monitorings',
            'periodeList',
            'selectedWeek',
            'tahunList',
            'skpdList',
            'pjList',
            'totalSkpd',
            'selesai',
            'review',
            'belum',
            'dalamProses',
            'progress',
            'trendLabels',
            'trendData',
            'progressPj'
        ));
    }
}