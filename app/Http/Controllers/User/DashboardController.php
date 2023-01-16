<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = Tugas::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->where('is_complete', 0)->get();
        return view('pages.user.dashboard.index', compact('tugas'));
    }

   
}
