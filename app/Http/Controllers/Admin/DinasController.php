<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Dinas;
use Illuminate\Http\Request;
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

        $dinas = Dinas::with('user')
            ->withcount('dinas_lampiran')
            ->filter($params)
            ->latest()
            ->paginate($params['show'] ?? 10);
        return view('pages.admin.dinas.index', compact('dinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
            return redirect()->route('admin.dinas.index');
        } else {
            Alert::error('Gagal', 'Data gagal dihapus');
            return redirect()->route('admin.dinas.index');
        }
    }

    public function approve($id)
    {
        $dinas = Dinas::findOrFail($id);
        $dinas->is_approved = '1';
        $dinas->save();

        Alert::success('Success', 'Dinas berhasil di approve');
        return redirect()->route('admin.dinas.index');
    }

    public function reject($id)
    {
        $dinas = Dinas::findOrFail($id);
        $dinas->is_approved = '2';
        $dinas->save();

        Alert::success('Success', 'Dinas berhasil di reject');
        return redirect()->route('admin.dinas.index');
    }

     public function exportPDF($id)
    {
         $dinas = Dinas::withcount('dinas_lampiran')->findOrFail($id);
        return view('pages.admin.dinas.dinaspdf', compact('dinas'));
    }

     public function exportPDFList(Request $request)
    {
        $params = $request->except('_token');

        $user = auth()->user();

        $dinas = Dinas::withcount('dinas_lampiran')->latest()->filter($params)->paginate($params['show'] ?? 10);

        return view('pages.admin.dinas.dinaspdflist', compact('dinas', 'user'));
    }

    public function rejectDinas($id)
    {
        $dinas = Dinas::findOrFail($id);

        return view('pages.admin.dinas.reject-modal', compact('dinas'));
    }

    public function rejectUpdateDinas(Request $request, $id)
    {
        $dinas = Dinas::findOrFail($id);

        $dinas->update([
            'is_approved' => '2',
            'alasan_reject' => $request->alasan_reject,
        ]);

        Alert::success('Success', 'Data berhasil di reject');
        return redirect()->route('admin.dinas.index');
    }

    public function alasanReject($id)
    {
        $dinas = Dinas::find($id);

        return view('pages.admin.dinas.alasan-reject', compact('dinas'));
    }
}
