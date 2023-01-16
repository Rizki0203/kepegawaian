<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

        $kontrak = Kontrak::with('user')->latest()->filter($params)->paginate($params['show'] ?? 10);
        return view('pages.admin.kontrak.index', compact('kontrak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('pages.admin.kontrak.create', compact('users'));
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
            'jenis_kontrak' => 'required',
            'mulai_kontrak' => 'required',
            'berakhir_kontrak' => 'required|after:mulai_kontrak',
        ]);

        // STORE
        $kontrak = Kontrak::create([
            'user_id'       => $request->user_id,
            'jenis_kontrak'    => $request->jenis_kontrak,
            'mulai_kontrak'    => $request->mulai_kontrak,
            'berakhir_kontrak' => $request->berakhir_kontrak,
        ]);

        // REDIRECT
        if ($kontrak) {
            Alert::success('Berhasil', 'Data kontrak berhasil disimpan');
            return redirect()->route('admin.kontrak.index');
        } else {
            Alert::error('Gagal', 'Data kontrak gagal disimpan');
            return redirect()->route('admin.kontrak.index');
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
        $kontrak = Kontrak::find($id);
        $users = User::where('role', 'user')->get();
        return view('pages.admin.kontrak.edit', compact('kontrak', 'users'));
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
        // find
        $kontrak = Kontrak::find($id);

        // VALIDATE
        $request->validate([
            'user_id' => 'required',
            'jenis_kontrak' => 'required',
            'mulai_kontrak' => 'required',
            'berakhir_kontrak' => 'required|after:mulai_kontrak',
        ]);

        // STORE
        $kontrak->update([
            'user_id'       => $request->user_id,
            'jenis_kontrak'    => $request->jenis_kontrak,
            'mulai_kontrak'    => $request->mulai_kontrak,
            'berakhir_kontrak' => $request->berakhir_kontrak,
        ]);

        // REDIRECT
        if ($kontrak) {
            Alert::success('Berhasil', 'Data kontrak berhasil disimpan');
            return redirect()->route('admin.kontrak.index');
        } else {
            Alert::error('Gagal', 'Data kontrak gagal disimpan');
            return redirect()->route('admin.kontrak.index');
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
        $kontrak = Kontrak::find($id);

        // delete
        $kontrak->delete();

        // redirect
        if ($kontrak) {
            Alert::success('Berhasil', 'Data kontrak berhasil dihapus');
            return redirect()->route('admin.kontrak.index');
        } else {
            Alert::error('Gagal', 'Data kontrak gagal dihapus');
            return redirect()->route('admin.kontrak.index');
        }
    }

    public function exportPDF($id)
    {
         $kontrak = Kontrak::findorfail($id);

        return view('pages.user.kontrak.kontrakpdf', compact('kontrak'));
    }
}
