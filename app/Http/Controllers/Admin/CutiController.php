<?php

namespace App\Http\Controllers\Admin;

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
        $cuti = Cuti::latest()->filter($params)->paginate($params['show'] ?? 10);

        return view('pages.admin.cuti.index', compact('cuti'));
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
         $cuti = Cuti::findOrFail($id);
        
        $cuti->delete();

        Alert::success('Success', 'Cuti berhasil di hapus');
        return redirect()->route('admin.cuti.index');
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->is_approved = '1';
        $cuti->save();

        Alert::success('Success', 'Cuti berhasil di approve');
        return redirect()->route('admin.cuti.index');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->is_approved = '2';
        $cuti->save();

        Alert::success('Success', 'Cuti berhasil di reject');
        return redirect()->route('admin.cuti.index');
    }

     public function exportPDF($id)
    {
         $cuti = Cuti::findOrFail($id);
        return view('pages.admin.cuti.cutipdf', compact('cuti'));
    }

     public function exportPDFList(Request $request)
    {
        $params = $request->except('_token');

        $user = auth()->user();

        $cuti = Cuti::latest()->filter($params)->paginate($params['show'] ?? 10);

        return view('pages.admin.cuti.cutipdflist', compact('cuti', 'user'));
    }

    public function rejectCuti($id)
    {
        $cuti = Cuti::findOrFail($id);

        return view('pages.admin.cuti.reject-modal', compact('cuti'));
    }

    public function rejectUpdateCuti(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'is_approved' => '2',
            'alasan_reject' => $request->alasan_reject,
        ]);

        Alert::success('Success', 'Data berhasil di reject');
        return redirect()->route('admin.cuti.index');
    }

    public function alasanReject($id)
    {
        $cuti = Cuti::findOrFail($id);

        return view('pages.admin.cuti.alasan-reject', compact('cuti'));
    }
    
}
