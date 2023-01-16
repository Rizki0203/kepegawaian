<?php

namespace App\Http\Controllers\User;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

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
        $tugas = Tugas::where('user_id', auth()->user()->id)
            ->with('user')
            ->orderBy('is_complete', 'asc')
            ->filter($params)
            ->latest()
            ->paginate($params['show'] ?? 10);
        return view('pages.user.tugas.index', compact('tugas'));
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
        //
    }

    public function selesai($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->is_complete = '1';
        $tugas->save();

        Alert::success('Success', 'Data berhasil diperbarui');
        return redirect()->route('user.tugas.index');
    }

    public function exportPDF(Request $request)
    {
        $params = $request->except('_token');

        $user = auth()->user();

        $tugas = Tugas::where('user_id', auth()->user()->id)
            ->with('user')
            ->filter($params)
            ->orderBy('is_complete', 'asc')
            ->latest()
            ->paginate($params['show'] ?? 10);

        return view('pages.user.tugas.tugaspdf', compact('tugas', 'user'));
    }
}
