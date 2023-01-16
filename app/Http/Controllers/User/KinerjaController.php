<?php

namespace App\Http\Controllers\User;

use App\Models\Tugas;
use App\Models\Kinerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class KinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

        $kinerja = Kinerja::with('tugas.user')
            ->whereHas('tugas', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->filter($params)
            ->paginate($params['show'] ?? 10);

        return view('pages.user.kinerja.index', compact('kinerja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tugas = Tugas::where('user_id', auth()->user()->id)
            ->where('is_complete', '0')
            ->get();

        return view('pages.user.kinerja.create', compact('tugas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'tugas_id' => 'required',
            'aktifitas' => 'required',
            'keterangan' => 'required',
        ]);

        // Insert
        $kinerja = Kinerja::create([
            'tugas_id' => $request->tugas_id,
            'aktifitas' => $request->aktifitas,
            'keterangan' => $request->keterangan,
        ]);

        // find tugas

        $tugas = Tugas::find($request->tugas_id);

        // update tugas is_complete 1

        $tugas->update([
            'is_complete' => 1,
        ]);

        // Redirect
        if ($kinerja) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('user.kinerja.index');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('user.kinerja.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kinerja = Kinerja::find($id);

        $tugas = Tugas::where('user_id', auth()->user()->id)->get();

        if (!$kinerja) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->route('user.kinerja.index');
        }

        return view('pages.user.kinerja.edit', compact('kinerja', 'tugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kinerja = Kinerja::find($id);

        // Validate
        $request->validate([
            'tugas_id' => 'required',
            'aktifitas' => 'required',
            'keterangan' => 'required',
        ]);

        // Insert
        $kinerja->update([
            'tugas_id' => $request->tugas_id,
            'aktifitas' => $request->aktifitas,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect
        if ($kinerja) {
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect()->route('user.kinerja.index');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect()->route('user.kinerja.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find
        $kinerja = Kinerja::find($id);

        // delete
        $kinerja->delete();

        // redirect
        if ($kinerja) {
            Alert::success('Berhasil', 'Data berhasil dihapus');
            return redirect()->route('user.kinerja.index');
        } else {
            Alert::error('Gagal', 'Data gagal dihapus');
            return redirect()->route('user.kinerja.index');
        }
    }

    public function exportPDF(Request $request)
    {
        $params = $request->except('_token');

        $user = auth()->user();

        $kinerja = Kinerja::with('tugas.user')
            ->whereHas('tugas', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->filter($params)
            ->paginate($params['show'] ?? 10);

        return view('pages.user.kinerja.kinerjapdf', compact('kinerja', 'user'));
    }
}
