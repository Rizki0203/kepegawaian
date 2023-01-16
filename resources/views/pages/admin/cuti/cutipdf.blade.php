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

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

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
                <div class="text-center" style="font-weight: bold; text-transform: uppercase; font-size:20px;">
                    <div>SURAT PERMOHONAN CUTI</div>
                </div>
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            Kepada Yth.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>HRD</b>
                        </td>
                    </tr>
                    <tr>
                        <td>di Tempat</td>
                    </tr>
                </table>
                <br />
                <br />

                <p>Yang bertanda tangan di bawah ini :</p>

                <table>
                    <tr>
                        <td width="100px">Nama</td>
                        <td width="50px">:</td>
                        <td>{{ $cuti->user->name }}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{ $cuti->user->profile->no_ktp }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $cuti->user->role == 'user' ? 'Karyawan' : '-' }}</td>
                    </tr>

                </table>
                <p> dengan ini mengajukan permintaan cuti karena alasan <b>{{ $cuti->keterangan }}</b> Selama {{ $cuti->total_cuti }} Hari terhitung mulai tanggal {{ \Carbon\Carbon::parse($cuti->mulai_cuti)->isoFormat('dddd, D MMMM Y') }} s/d {{ \Carbon\Carbon::parse($cuti->berakhir_cuti)->isoFormat('dddd, D MMMM Y') }}</p>
                <p>Demikianlah permintaan ini saya buat untuk dapat dipertimbangkan sebagaimana mestinya</p>
                <br />
                <br />
                <br />
                <br />
                <div class="text-end"> Banjarmasin, {{ \Carbon\Carbon::today()->isoFormat('dddd, D MMMM Y') }}</div>
                <table class="table">
                    <tr class="text-center">
                        <td>Diajukan oleh,</td>
                        <td>Disetujui oleh,</td>
                        <td>Diketahui oleh,</td>
                    </tr>
                    <tr class="text-center">
                        <td>Karyawan Yang Cuti</td>
                        <td>Atasan Langsung</td>
                        <td>HR&GA</td>
                    </tr>
                    <tr>
                        <td><br /><br /><br /></td>
                        <td><br /><br /><br /></td>
                        <td><br /><br /><br /></td>
                    </tr>
                    <tr class="text-center">
                        <td><b>{{ $cuti->user->name }}</b></td>
                        <td>_______________________</td>
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
