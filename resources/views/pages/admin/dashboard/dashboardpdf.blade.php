<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <style>
        .container {
            max-width: 700px;
            margin: 0 auto;
            box-sizing: border-box;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
        }

        .table {
            width: 100%;
        }

        .table td,
        .table th {
            padding: 5px 10px;
        }

        .card-body {
            pointer-events: none;
        }
    </style>
</head>

@php
    $carbonyear = Carbon\Carbon::now()->isoFormat('Y');
@endphp

<div class="container">
    {{-- <h3 class="mb-4">Report Absensi Karyawan Daily</h3> --}}
    <div class="card border-5 border">
        <div class="card-body pb-0">{!! $chart->container() !!}</div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <span>List Karyawan Belum Absen <b>
                    @if (isset($_GET['date']))
                        {{ Carbon\Carbon::parse($_GET['date'])->isoFormat('MMMM Y') }}
                    @else
                        {{ Carbon\Carbon::today()->isoFormat('MMMM Y') }}
                    @endif
                </b>
            </span>
            <div class="table-responsive">
                <table class=" table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Tgl Tugas</th>
                            <th>Tgl Dealdine</th>
                            <th>Status Hari</th>
                            <th>Status Pengerjaan</th>
                            <th>Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mulai)->isoFormat('DD MMM Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->berakhir)->isoFormat('DD MMM Y') }}</td>
                                <td><span class="badge bg-warning text-dark">Sisa {{ $item->sisahari }}</span></td>
                                <td>{!! $item->StatusComplete !!}</td>
                                <td>{{ $item->tugas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Tidak Ada Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

<script>
    // print after 5 seconds
    setTimeout(function() {
        window.print();
    }, 1300);
</script>

</body>

</html>
