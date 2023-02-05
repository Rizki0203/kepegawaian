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
            width: 70%;
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

@php
    function romawi($bln)
    {
        switch ($bln) {
            case 1:
                return 'I';
                break;
            case 2:
                return 'II';
                break;
            case 3:
                return 'III';
                break;
            case 4:
                return 'IV';
                break;
            case 5:
                return 'V';
                break;
            case 6:
                return 'VI';
                break;
            case 7:
                return 'VII';
                break;
            case 8:
                return 'VIII';
                break;
            case 9:
                return 'IX';
                break;
            case 10:
                return 'X';
                break;
            case 11:
                return 'XI';
                break;
            case 12:
                return 'XII';
                break;
        }
    }
    
    $bulan = romawi(date('m'));
    
@endphp

<body>
    <div class="container">
        <table id="kop">
            <tr>
                <td class="logo" width="100px">
                    <div class="logo-left">
                        <img class="logo-image" src="{{ asset('assets/img/icons/bphl.png') }}" alt="Logo">
                    </div>
                </td>
                <td>
                    <div class="header">
                        <div style="font-weight: bold; text-transform: uppercase; font-size:20px;">
                            <div>KEMENTRIAN LINGKUNGAN HIDUP DAN KEHUTANAN</div>
                            <div>SEKRETARIAT JENDERAL</div>
                        </div>

                        <small style="font-size: 16px;">JL. Ir. Pangeran M. Noor, Kemuning, Kec. Banjarbaru Selatan, Kota Banjar Baru</small>
                    </div>
                </td>

            </tr>
            <tr>
                <td colspan="3">
                    <div class="line"></div>
                    <div class="hair-line"></div>
                </td>
            </tr>
        </table>

        <div style="padding-top: 0; padding-bottom: 0.75rem;">

            <div class="font-surat">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td width="320px">B.000{{ $dinas->id }}/BPHL/TU/{{ $bulan }}/{{ date('Y') }}</td>
                        <td>Banjarmasin, {{ \Carbon\Carbon::today()->isoFormat('dddd, D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lamp.</td>
                        <td>:</td>
                        <td>{{ $dinas->dinas_lampiran_count }} Lampiran</td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td>{{ $dinas->perihal }} Lampiran</td>
                    </tr>
                </table>

                <br />
                <div>Kepada Yth.</div>
                <div>{{ $dinas->tujuan }}</div>
                <div>di-</div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;Tempat</div>
                <br />
                <div>Yang bertanda tangan di bawah ini :</d>
                    <table>
                        <tr>
                            <td width="100px">Nama</td>
                            <td width="50px">:</td>
                            <td>{{ $dinas->user->name }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $dinas->user->profile->no_ktp }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $dinas->user->role == 'user' ? 'Karyawan' : '-' }}</td>
                        </tr>
                    </table>
                    <br />

                    <d>Mengajukan permohonan {{ $dinas->jenis_surat_dinas }}, dengan alasan :</d>
                        
                        <div>{{ $dinas->alasan }}.<br/>
                        Dan akan dilakukan pada tanggal : {{ \Carbon\Carbon::parse($dinas->mulai_dinas)->isoFormat('DD MMMM Y') }} - {{ \Carbon\Carbon::parse($dinas->berakhir_dinas)->isoFormat('DD MMMM Y') }}
                        </div>
                        <div>Sebagai bahan pertimbangan saya lampirkan :</div>
                        <ol>
                            @foreach ($dinas->dinas_lampiran as $item)
                                <li>{{ $item->lampiran }}</li>
                            @endforeach
                        </ol>
                        <div>Demikian Surat Permohonan Dinas ini dibuat, atas perhatiannya saya ucapkan terimakasih</div>
                        <br />
                        <br />
                        <table class="table">
                            <tr class="text-center">
                                <td>Pemohon</td>
                                <td>Disetujui oleh,</td>
                            </tr>
                            <tr>
                                <td><br /><br /><br /></td>
                                <td><br /><br /><br /></td>
                                <td><br /><br /><br /></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>{{ $dinas->user->name }}</b></td>
                                <td>_______________________</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                // make print size is f4
                $(document).ready(function() {
                    $('.container').css('height', '100%');
                    $('.container').css('width', '100%');
                    $('.container').css('padding-top', '10%');
                    $('.container').css('padding-bottom', '10%');
                    $('.container').css('padding-left', '5%');
                    $('.container').css('padding-right', '5%');
                    $('.container').css('margin', '0');
                    $('.container').css('font-size', '12px');
                    $('.container').css('font-family', 'Arial, Helvetica, sans-serif');

                    $('.logo-left').css('padding', '0');
                    $('.logo-left').css('margin', '0');

                    $('.logo-image').css('width', '100%');

                    $('.header').css('padding', '0');
                    $('.header').css('margin', '0');
                    $('.header').css('text-align', 'center');
                    $('.header').css('font-weight', 'bold');
                    $('.header').css('text-transform', 'uppercase');

                    $('.line').css('border', '1px solid black');
                    $('.line').css('margin', '0');
                    $('.line').css('padding', '0');

                    $('.hair-line').css('border', '1px dashed black');
                    $('.hair-line').css('margin', '0');
                    $('.hair-line').css('padding', '0');

                    $('.font-surat').css('font-size', '12px');
                    $('.font-surat').css('font-family', 'Arial, Helvetica, sans-serif');

                    $('.table-bordered').css('border', '1px solid black');
                    $('.table-bordered').css('border-collapse', 'collapse');
                    $('.table-bordered').css('margin', '0');
                    $('.table-bordered').css('padding', '0');

                    $('.table').css('margin', '0');
                    $('.table').css('padding', '0');
                    $('.table').css('border-collapse', 'collapse');

                    $('.table td').css('padding', '3px');
                    $('.table th').css('padding', '3px');
                    $('.table td').css('border', '1px solid black');
                    $('.table th').css('border', '1px solid black');

                    $('.text-center').css('text-align', 'center');
                });
            </script>

            <script>
                window.onload = function() {
                    window.print();
                };
            </script>
</body>

</html>
