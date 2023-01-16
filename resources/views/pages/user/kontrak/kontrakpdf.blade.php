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
    <div class="container">

        <div class="header">
            <div style="font-weight: bold; text-transform: uppercase; font-size:20px; ">
                SURAT KONTRAK KERJA
            </div>
        </div>
        <div style="padding-top: 0; padding-bottom: 0.75rem;">

            <div class="font-surat">
                <p>Yang bertanda tangan dibawah ini :</p>
                <table>
                    <tr>
                        <td width="100px">Nama</td>
                        <td width="50px">:</td>
                        <td>Yudita Nurdiana</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>Kepala UPTD BPTH</td>
                    </tr>
                </table>
                <p> Dalam hal ini bertindak untuk dan atas Nama BPHL IX Banjarbaru Ditjen PHL di JL. Ir. Pangeran M. Noor, Kemuning, Kec. Banjarbaru Selatan, Kota Banjar Baru yang akan disebut Pihak Pertama.</p>
                <table>
                    <tr>
                        <td width="100px">Nama</td>
                        <td width="50px">:</td>
                        <td>{{ $kontrak->user->name }}</td>
                    </tr>
                </table>
                <p>Pada hari {{ \Carbon\Carbon::parse($kontrak->created_at)->isoFormat('dddd, D MMMM Y') }}, dengan memilih tempat di BPHL IX Banjarbaru Ditjen PHL Pihak Pertama dan Pihak Kedua sepakat untuk saling terikat dalam surat kontrak kerja karyawan dengan syarat dan ketentuan diatur sebagai berikut :</p>
                <br />
                <p class="text-center" style="line-height:0;"> PASAL 1 KETENTUAN UMUM</p>
                <ol style="mar">
                    <li>
                        <p>Pihak Kedua akan taat serta tunduk pada tata tertib yang berlaku, perintah langsung maupun tidak dari Pihak Pertama maupun wakil dari BPHL IX Banjarbaru Ditjen PHL</p>
                    </li>
                    <li>
                        <p>Apabila Pihak Kedua melakukan pelanggaran kerja maka Pihak Pertama berhak memberikan sanksi sesuai dengan pelanggaran yang dilakukan oleh Pihak Kedua</p>
                    </li>
                </ol>

                <p class="text-center" style="line-height:0;"> PASAL 2 JANGKA WAKTU</p>
                <ol>
                    <li>
                        <p>Kontrak kerja ini akan akan berlaku selama <b>{{ $kontrak->total_hari }}</b> berdasarkan jenis kontrak yang diberikan yaitu Kontrak {{ $kontrak->jenis_kontrak }}</p>
                    </li>
                    <li>
                        <p>Apabila Kontrak Kerja ini habis masa berlakunya, maka kedua belah pihak bisa melakukan perpanjangan kontrak baru dengan kesepakatan bersama</p>
                    </li>
                </ol>
                  <p class="text-center" style="line-height:0;"> PASAL 3 UPAH</p>
                <ol>
                    <li>
                        <p>Pihak kedua akan menerima gaji sebesar Rp. 3.000.000,00 (tiga juta rupiah) perbulannya</p>
                    </li>
                </ol>

                <br />
                <br />
                <table class="table">
                    <tr class="text-center">
                        <td>Pihak Pertama</td>
                        <td>Pihak Kedua</td>
                    </tr>
                    <tr>
                        <td><br /><br /><br /></td>
                        <td><br /><br /><br /></td>
                        <td><br /><br /><br /></td>
                    </tr>
                    <tr class="text-center">
                        <td><b>{{ $kontrak->user->name }}</b></td>
                        <td><b>Yudita Nurdiana</b></td>
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
