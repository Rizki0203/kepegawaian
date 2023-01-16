<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Tugas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DailyChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $filterDate = Carbon::parse(request('date', Carbon::now()->startOfMonth()->toDateString(),));

        // count tugas on this mounth
        $tugas = Tugas::whereMonth('created_at', $filterDate->month)->count();

        $tugasBelum = Tugas::whereMonth('created_at', $filterDate->month)->where('is_complete', 0)->count();
        $tugasSudah = Tugas::whereMonth('created_at', $filterDate->month)->where('is_complete', 1)->count();


        $carbon = Carbon::parse($filterDate)->isoFormat('MMMM Y');


        return $this->chart->pieChart()
            ->setTitle('Monitoring Pengerjaan Tugas Pegawai')
            ->setSubtitle($carbon)
            ->addData([$tugas ?? 0, $tugasBelum ?? 0, $tugasSudah ?? 0])
            ->setLabels(['Pemberian Tugas', 'Tidak Mengerjakan Tugas', 'Tugas Selesai']);
    }
}
