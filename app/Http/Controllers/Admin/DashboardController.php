<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tugas;
use App\Charts\DailyChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(DailyChart $chart, Request $request)
    {

        $params = $request->except('_token');

        return view('pages.admin.dashboard.index',  ['chart' => $chart->build()],);
    }

    public function exportPDF(DailyChart $chart, Request $request)
    {
        $params = $request->except('_token');

        // get tugas where month this month by request
       $tugas = Tugas::whereMonth('created_at', Carbon::parse($request->date)->format('m Y'))->get();
         
         return view('pages.admin.dashboard.dashboardpdf',  ['chart' => $chart->build()], compact('tugas'));
    }
}
