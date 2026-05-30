<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $q = $request->q;

        $skpds = Skpd::when($q, function ($query) use ($q) {

            $query->where('nama', 'like', '%' . $q . '%')
                  ->orWhere('singkatan', 'like', '%' . $q . '%');

        })->latest()->get();

        return view('skpd.index', compact('skpds', 'q'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('skpd.create');
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
            'singkatan' => 'required',
            'deskripsi' => 'nullable',
        ]);

        // cek apakah nama sudah ada
        $cek = Skpd::where('nama', $request->nama)->exists();

        if ($cek) {
            return redirect()->route('skpd.index')
                    ->with('error', 'Nama SKPD sudah pernah diinput.');
        }

        Skpd::create([
            'nama' => $request->nama,
            'singkatan' => $request->singkatan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('skpd.index')
                ->with('success', 'Data SKPD berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $skpd = Skpd::findOrFail($id);

        return view('skpd.edit', compact('skpd'));
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
            'singkatan' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $cek = Skpd::where('nama', $request->nama)
                    ->where('id', '!=', $id)
                    ->exists();

        if ($cek) {
            return redirect()
                ->route('skpd.index')
                ->with('error', 'Nama SKPD sudah digunakan oleh data lain.');
        }

        $skpd = Skpd::findOrFail($id);

        $skpd->update([
            'nama' => $request->nama,
            'singkatan' => $request->singkatan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('skpd.index')
                ->with('success', 'Data SKPD berhasil diupdate.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $skpd = Skpd::findOrFail($id);

        $skpd->delete();

        return redirect('/skpd')
            ->with('success', 'Data SKPD berhasil dihapus');
    }
}