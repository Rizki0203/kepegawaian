<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            box-sizing: border-box;
            padding-left: 20px;
            padding-right: 20px;
        }

        .font-12 {
            font-size: 16px;
        }

        #kop td.logo {
            width: 130px;
            height: 130px;
        }

        .logo-image {
            width: 100%;
        }

        .logo-left {
            display: flex;
            justify-content: start;
        }

        .logo-right {
            display: flex;
            justify-content: end;
        }

        .header {
            text-align: center;
        }

        .line {
            border-top: 2px solid black;
            margin-top: -10px;
            margin-bottom: 2px;
        }

        .hair-line {
            border-top: 1px solid black;
            margin-bottom: 5px;
        }

        #kop {
            width: 100%;
        }

        .table {
            width: 100%;
        }

        .table td,
        .table th {
            padding: 5px 10px;
        }

        .uppercase {
            letter-spacing: 200px;
        }

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
        }

        .font-surat {
            /* text-indent: 30px; */
            text-align: justify;
            font-size: 17px;
            line-height: 1.5;
        }

        p.surat {
            /* text-indent: 30px; */
            text-align: justify;
            font-size: 17px;
            line-height: 1.5;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="container">
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <h4>List Tugas Karyawan</h4>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="350px">
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td class="fw-bold">Periode Waktu</td>
                            </tr>
                            <tr>
                                <td>
                                    {{ @$_GET['tanggal'] ?? '-' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>

        </div>
        <table class="nowrap table-bordered table">
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

    <script>
        // make size paper landscape AFTER PRINT
        window.onafterprint = function() {
            document.body.classList.remove('landscape');
        };

        // make size paper landscape BEFORE PRINT
        window.onbeforeprint = function() {
            document.body.classList.add('landscape');
        };

        // print when page ready
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
