<?php

namespace App\Http\Controllers\Admin;

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
            ->latest()
            ->filter($params)
            ->paginate($params['show'] ?? 10);

        return view('pages.admin.kinerja.index', compact('kinerja'));
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

    public function exportPDFList(Request $request)
    {
        $params = $request->except('_token');

        $kinerja = Kinerja::with('tugas.user')
            ->latest()
            ->filter($params)
            ->paginate($params['show'] ?? 10);

        return view('pages.admin.kinerja.kinerjapdflist', compact('kinerja'));
    }
}
