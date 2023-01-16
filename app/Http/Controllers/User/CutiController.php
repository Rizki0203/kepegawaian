<?php

namespace App\Http\Controllers\User;

use App\Models\Cuti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');
        $cuti = Cuti::where('user_id', auth()->user()->id)->with('user')->latest()->paginate($params['show'] ?? 10);

        return view('pages.user.cuti.index', compact('cuti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE
        $request->validate([
            'mulai_cuti' => 'required',
            'berakhir_cuti' => 'required',
            'keterangan' => 'required',
        ]);

        // STORE
        $cuti = Cuti::create([
            'user_id'       => auth()->user()->id,
            'mulai_cuti'    => $request->mulai_cuti,
            'berakhir_cuti' => $request->berakhir_cuti,
            'keterangan'    => $request->keterangan,
        ]);

        // REDIRECT
        if ($cuti) {
            Alert::success('Berhasil', 'Data cuti berhasil disimpan');
            return redirect()->route('user.cuti.index');
        } else {
            Alert::error('Gagal', 'Data cuti gagal disimpan');
            return redirect()->route('user.cuti.index');
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
        $cuti = Cuti::findOrFail($id);

        return view('pages.user.cuti.edit', compact('cuti'));
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
        $cuti = Cuti::findOrFail($id);

          // VALIDATE
        $request->validate([
            'mulai_cuti' => 'required',
            'berakhir_cuti' => 'required',
            'keterangan' => 'required',
        ]);

        // STORE
        $cuti->update([
            'mulai_cuti'    => $request->mulai_cuti,
            'berakhir_cuti' => $request->berakhir_cuti,
            'keterangan'    => $request->keterangan,
        ]);

        // REDIRECT
        if ($cuti) {
            Alert::success('Berhasil', 'Data cuti berhasil diubah');
            return redirect()->route('user.cuti.index');
        } else {
            Alert::error('Gagal', 'Data cuti gagal diubah');
            return redirect()->route('user.cuti.index');
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
        $cuti = Cuti::findOrFail($id);

        $cuti->delete();

        if ($cuti) {
            Alert::success('Berhasil', 'Data cuti berhasil dihapus');
            return redirect()->route('user.cuti.index');
        } else {
            Alert::error('Gagal', 'Data cuti gagal dihapus');
            return redirect()->route('user.cuti.index');
        }
    }
}
