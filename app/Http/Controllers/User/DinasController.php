<?php

namespace App\Http\Controllers\User;

use Alert;
use App\Models\User;
use App\Models\Dinas;
use Illuminate\Http\Request;
use App\Models\DinasLampiran;
use App\Http\Controllers\Controller;

class DinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

        $dinas = Dinas::where('user_id', auth()->user()->id)->with('user')->latest()->withcount('dinas_lampiran')->paginate($params['show'] ?? 10);

        return view('pages.user.dinas.index', compact('dinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('pages.user.dinas.create', compact('users'));
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
            'user_id' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'jenis_surat_dinas' => 'required',
            'alasan' => 'required',
        ]);

        // STORE
        $dinas = Dinas::create([
            'user_id'           => $request->user_id,
            'tujuan'            => $request->tujuan,
            'perihal'           => $request->perihal,
            'mulai_dinas'       => $request->mulai,
            'berakhir_dinas'    => $request->berakhir,
            'jenis_surat_dinas' => $request->jenis_surat_dinas,
            'alasan'            => $request->alasan,
        ]);

        $lampirans = $request->input('lampiran');

        foreach ($lampirans as $lampiran) {
            $dinas->dinas_lampiran()->create([
                'lampiran' => $lampiran,
            ]);
        }

        // REDIRECT
        if ($dinas) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('user.dinas.index');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('user.dinas.index');
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
        // find 
        $dinas = Dinas::find($id);

        // return view
        return view('pages.user.dinas.edit', compact('dinas'));
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
        $dinas = Dinas::find($id);

        $request->validate([
            'tujuan' => 'required',
            'perihal' => 'required',
            'jenis_surat_dinas' => 'required',
            'alasan' => 'required',
        ]);

        // STORE
        $dinas->update([
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'jenis_surat_dinas' => $request->jenis_surat_dinas,
            'alasan' => $request->alasan,
        ]);

        $lampirans = $request->input('lampiran');

        DinasLampiran::where('dinas_id', $dinas->id)->delete();

        if($request->lampiran) {
        foreach($request->lampiran as $lampiran) {
            DinasLampiran::create([
                'dinas_id' => $dinas->id,
                'lampiran' => $lampiran
            ]);
        }
    }

        // REDIRECT
        if ($dinas) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('user.dinas.index');
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('user.dinas.index');
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
        $dinas = Dinas::find($id);

        $dinas->dinas_lampiran()->delete();

        $dinas->delete();

        if ($dinas) {
            Alert::success('Berhasil', 'Data berhasil dihapus');
            return redirect()->route('user.dinas.index');
        } else {
            Alert::error('Gagal', 'Data gagal dihapus');
            return redirect()->route('user.dinas.index');
        }
    }

    
}
