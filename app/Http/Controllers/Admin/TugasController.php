<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\User;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

        $tugas = Tugas::with('user')->latest()->filter($params)->paginate($params['show'] ?? 10);

        return view('pages.admin.tugas.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('pages.admin.tugas.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'user_id' => 'required',
            'berakhir' => 'required|after:today',
            'tugas' => 'required',
            'keterangan' => 'required',
        ]);

        // store
        $tugas = Tugas::create([
            'user_id' => $request->user_id,
            'mulai' => now(),
            'berakhir' => $request->berakhir,
            'tugas' => $request->tugas,
            'keterangan' => $request->keterangan,
        ]);

        if ($tugas) {
            Alert::success('Berhasil', 'Tugas berhasil ditambahkan');
            return redirect()->route('admin.tugas.index');
        } else {
            Alert::error('Gagal', 'Tugas gagal ditambahkan');
            return redirect()->route('admin.tugas.index');
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
        $tugas = Tugas::find($id);

        // get users
        $users = User::where('role', 'user')->get();

        return view('pages.admin.tugas.edit', compact('tugas', 'users'));
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
        $tugas = Tugas::find($id);

        $request->validate([
            'user_id' => 'required',
            'berakhir' => 'required|after:today',
            'tugas' => 'required',
            'keterangan' => 'required',
        ]);

        // store
        $tugas->update([
            'user_id' => $request->user_id,
            'mulai' => now(),
            'berakhir' => $request->berakhir,
            'tugas' => $request->tugas,
            'keterangan' => $request->keterangan,
        ]);

        if ($tugas) {
            Alert::success('Berhasil', 'Tugas berhasil ditambahkan');
            return redirect()->route('admin.tugas.index');
        } else {
            Alert::error('Gagal', 'Tugas gagal ditambahkan');
            return redirect()->route('admin.tugas.index');
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
        $tugas = Tugas::find($id);

        // delete
        $tugas->delete();

        if ($tugas) {
            Alert::success('Berhasil', 'Tugas berhasil dihapus');
            return redirect()->route('admin.tugas.index');
        } else {
            Alert::error('Gagal', 'Tugas gagal dihapus');
            return redirect()->route('admin.tugas.index');
        }
    }

    public function exportPDFList(Request $request)
    {
        $params = $request->except('_token');

        $tugas = Tugas::with('user')->latest()->filter($params)->paginate($params['show'] ?? 10);

        return view('pages.admin.tugas.tugaspdflist', compact('tugas'));
    }
}
