<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\PjSkpd;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Semua Monitoring
        |--------------------------------------------------------------------------
        */
        $allMonitorings = Monitoring::with(['skpd', 'pjskpd'])
            ->orderBy('tanggal_update', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Group Mingguan
        |--------------------------------------------------------------------------
        */
        $grouped = $allMonitorings->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_update)
                ->startOfWeek()
                ->format('Y-m-d');
        });

        /*
        |--------------------------------------------------------------------------
        | Dropdown Periode
        |--------------------------------------------------------------------------
        */
        $periodeList = [];

        foreach ($grouped as $startWeek => $items) {

            $mulai = Carbon::parse($startWeek);
            $akhir = Carbon::parse($startWeek)->endOfWeek();

            $periodeList[] = [
                'value' => $startWeek,
                'label' => 'Minggu ke-' .
                    $mulai->weekOfYear .
                    ' (' .
                    $mulai->format('d M') .
                    ' - ' .
                    $akhir->format('d M Y') .
                    ')'
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
        | Monitoring Mingguan
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
        | Progress
        |--------------------------------------------------------------------------
        */
        $progress = 0;

        if ($totalSkpd > 0) {
            $progress = round(($selesai / $totalSkpd) * 100);
        }

        /*
        |--------------------------------------------------------------------------
        | Trend Mingguan
        |--------------------------------------------------------------------------
        */
        $trendLabels = [];
        $trendData = [];

        foreach ($grouped as $startWeek => $items) {

            $minggu = Carbon::parse($startWeek);

            $selesaiMinggu = $items
                ->where('status', 'Sudah Selesai')
                ->count();

            $totalMinggu = $items
                ->pluck('skpd_id')
                ->unique()
                ->count();

            $persen = 0;

            if ($totalMinggu > 0) {
                $persen = round(($selesaiMinggu / $totalMinggu) * 100);
            }

            $trendLabels[] = 'Minggu-' . $minggu->weekOfYear;
            $trendData[] = $persen;
        }

        /*
        |--------------------------------------------------------------------------
        | Progress per PJ SKPD
        |--------------------------------------------------------------------------
        */

        $progressPj = [];

        $progressPjLabels = [];
        $progressPjData = [];

        $pjAll = PjSkpd::all();

        foreach ($pjAll as $pj) {

            // total monitoring PJ
            $totalMonitoringPj = $monitorings
                ->where('pj_skpd_id', $pj->id)
                ->count();

            // total selesai
            $totalSelesaiPj = $monitorings
                ->where('pj_skpd_id', $pj->id)
                ->where('status', 'Sudah Selesai')
                ->count();

            $persen = 0;

            if ($totalMonitoringPj > 0) {
                $persen = round(
                    ($totalSelesaiPj / $totalMonitoringPj) * 100
                );
            }

            $progressPj[] = [
                'nama' => $pj->nama,
                'persen' => $persen,
            ];

            // untuk chart batang
            $progressPjLabels[] = $pj->nama;
            $progressPjData[] = $persen;
        }

        /*
        |--------------------------------------------------------------------------
        | Dropdown Tahun
        |--------------------------------------------------------------------------
        */

        $tahunList = $allMonitorings
            ->pluck('tanggal_update')
            ->map(function ($tanggal) {
                return Carbon::parse($tanggal)->year;
            })
            ->unique()
            ->sort();

        /*
        |--------------------------------------------------------------------------
        | Dropdown SKPD
        |--------------------------------------------------------------------------
        */

        $skpdList = $allMonitorings
            ->pluck('skpd.nama')
            ->unique()
            ->filter()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Dropdown PJ SKPD
        |--------------------------------------------------------------------------
        */

        $pjList = $allMonitorings
            ->pluck('pjskpd.nama')
            ->unique()
            ->filter()
            ->values();

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
            'progressPj',
            'progressPjLabels',
            'progressPjData',
        ));
    }
}