<?php

namespace App\Http\Controllers;

use App\Models\PjSkpd;
use App\Models\Skpd;
use Illuminate\Http\Request;

class PjSkpdController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $q = $request->q;

        $pjskpds = PjSkpd::with('skpd')
            ->when($q, function ($query) use ($q) {

                $query->where('nama', 'like', '%' . $q . '%')
                      ->orWhere('nip', 'like', '%' . $q . '%');

            })->latest()->get();

        return view('pjskpd.index', compact('pjskpds'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $skpds = Skpd::orderBy('nama')->get();

        return view('pjskpd.create', compact('skpds'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'skpd_id' => 'required',
            'no_hp' => 'nullable',
            'email' => 'nullable|email',
        ]);

        PjSkpd::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'skpd_id' => $request->skpd_id,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('pjskpd.index')
            ->with('success', 'Data PJ SKPD berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $pjskpd = PjSkpd::findOrFail($id);
        $skpds = Skpd::orderBy('nama')->get();

        return view('pjskpd.edit', compact('pjskpd', 'skpds'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'skpd_id' => 'required',
            'no_hp' => 'nullable',
            'email' => 'nullable|email',
        ]);

        $pjskpd = PjSkpd::findOrFail($id);

        $pjskpd->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'skpd_id' => $request->skpd_id,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('pjskpd.index')
            ->with('success', 'Data PJ SKPD berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $pjskpd = PjSkpd::findOrFail($id);

        $pjskpd->delete();

        return redirect()
            ->route('pjskpd.index')
            ->with('success', 'Data PJ SKPD berhasil dihapus');
    }
}