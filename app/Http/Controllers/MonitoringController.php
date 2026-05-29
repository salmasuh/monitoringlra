<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\PjSkpd;
use App\Models\Skpd;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $q = $request->q;

        $monitorings = Monitoring::with(['skpd', 'pjskpd'])

            ->when($q, function ($query) use ($q) {

                $query->whereHas('skpd', function ($q2) use ($q) {
                    $q2->where('nama', 'like', '%' . $q . '%');
                })

                ->orWhereHas('pjskpd', function ($q3) use ($q) {
                    $q3->where('nama', 'like', '%' . $q . '%');
                });

            })
            ->latest()
            ->get();

        return view('monitoring.index', compact('monitorings'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        $skpds = Skpd::orderBy('nama')->get();
        $selectedSkpd = $request->skpd_id;
        $pjskpds = [];

        if ($selectedSkpd) {
            $pjskpds = PjSkpd::where('skpd_id', $selectedSkpd)
                ->orderBy('nama')
                ->get();
        }

        return view('monitoring.create', compact(
            'skpds',
            'pjskpds',
            'selectedSkpd'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'skpd_id' => 'required',
            'pj_skpd_id' => 'required',
            'status' => 'required',
            'tanggal_update' => 'required|date',
            'catatan' => 'nullable',
        ]);

        Monitoring::create([
            'skpd_id' => $request->skpd_id,
            'pj_skpd_id' => $request->pj_skpd_id,
            'status' => $request->status,
            'tanggal_update' => $request->tanggal_update,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $skpds = Skpd::orderBy('nama')->get();
        $pjskpds = PjSkpd::where('skpd_id', $monitoring->skpd_id)
            ->orderBy('nama')
            ->get();

        return view('monitoring.edit', compact(
            'monitoring',
            'skpds',
            'pjskpds'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'skpd_id' => 'required',
            'pj_skpd_id' => 'required',
            'status' => 'required',
            'catatan' => 'nullable',
        ]);

        $monitoring = Monitoring::findOrFail($id);

        $monitoring->update([
            'skpd_id' => $request->skpd_id,
            'pj_skpd_id' => $request->pj_skpd_id,
            'status' => $request->status,
            'tanggal_update' => now(),
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $monitoring->delete();

        return redirect()->route('monitoring.index')
                ->with('success', 'Data monitoring berhasil dihapus');
    }
}