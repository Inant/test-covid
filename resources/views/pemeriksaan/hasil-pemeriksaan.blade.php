<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Klinik Dokterku</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
  =========================================================
  * ArchitectUI HTML Theme Dashboard - v1.0.0
  =========================================================
  * Product Page: https://dashboardpack.com
  * Copyright 2019 DashboardPack (https://dashboardpack.com)
  * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
  =========================================================
  * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
  -->
    <link href="{{ asset('') }}main.css" rel="stylesheet">
    <link href="{{ asset('') }}custom.css" rel="stylesheet">
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 4;
        }

        table {
            /* margin-left: 12px;
            margin-right: 12px; */
        }

        hr {
            border: none;
            height: 1px;
            /* Set the hr color */
            color: #333;
            /* old IE */
            background-color: #333;
            /* Modern Browsers */
        }

        body {
            color: #333;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <br>
    {{-- <center> --}}
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td style="text-align:left">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
                        </td>
                        <td style="text-align:center">
                            <h3 class="">LABORATORIUM KLINIK DOKTERKU</h3>
                            <p>Jl. Raya Tukum Rt 20 Rw 06 Kecamatan Tekung Kabupaten Lumajang</p>
                            <p>Telepon (0334) 8797171 Hp. 085854649375 Email : klinikdokterku@yahoo.com</p>
                        </td>
                    </tr>
                </table>
            </div>
            {{-- <div class="col-md-8">
                <h3 class="">LABORATORIUM KLINIK DOKTERKU</h3>
                <p>Jl. Raya Tukum Rt 20 Rw 06 Kecamatan Tekung Kabupaten Lumajang</p>
                <p>Telepon (0334) 8797171 Hp. 085854649375 Email : klinikdokterku@yahoo.com</p>
            </div> --}}
        </div>
        <hr>
    {{-- </center> --}}
    <br>

    <div class="row">
        <div class="col-md-12">
            <table style="border-spacing: 25px !important;" width="30%">
                <tr>
                    <td>NAMA</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->nama_pasien) }}</td>
                </tr>
                <tr>
                    <td>UMUR</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->umur) }} TAHUN</td>
                </tr>
                <tr>
                    <td>ALAMAT</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->alamat) }}</td>
                </tr>
                <tr>
                    <td>PENGIRIM</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pengirim) }}</td>
                </tr>
                <tr>
                    <td>NO REGISTER</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->no_reg) }}</td>
                </tr>
            </table>
            <br>
            <br>
            <center>
                <table width="100%" border="1" cellpadding="">
                    <thead>
                        <tr style="text-align:center">
                            <th>PEMERIKSAAN</th>
                            <th>HASIL</th>
                            <th>HASIL NORMAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pemeriksaan->details !== null)
                            @foreach ($pemeriksaan->details as $key => $item)
                                <tr style="text-align:center">
                                    <td>{{ $item->tipe->tipe }}</td>
                                    <td>{{ $item->hasil }}</td>
                                    <td>{{ $item->tipe->nilai_normal }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                            </tr>
                        @endif
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center>
            <br>
            <p class="ml-2">{{ $pemeriksaan->keterangan }}</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <table style="width:100%;margin-left:10px">
                <tr>
                    <td style="text-align:left">
                        {!! QrCode::size(100)->generate(url('pemeriksaan/' . $pemeriksaan->id_pemeriksaan)) !!}
                    </td>
                    <td style="text-align:right">
                        <p class="text-center">Lumajang, {{ $pemeriksaan->tgl_pemeriksaan }}</p>
                        <p class="text-center">Penanggung Jawab</p>
                        <br>
                        <br>
                        <br>
                        <p class="text-center">{{ $pemeriksaan->dokter->nama_dokter }}</p>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</body>

</html>
