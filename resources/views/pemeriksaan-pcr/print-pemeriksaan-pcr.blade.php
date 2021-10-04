<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Klinik Dokterku</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-asli.png') }}" type="image/x-icon">
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

        .keterangan{
            border: 1px solid black;
            padding: 5px;
            margin: 5px;
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
                        <td style="text-align:center">
                            <img src="{{ asset('assets/images/logo-asli.png') }}" width="100" alt="">
                        </td>
                        <td style="text-align:center">
                            <h3 class="">LABORATORIUM KLINIK DOKTERKU</h3>
                            <p>No Izin : 445/1716/427.55.2019</p>
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
            <center>
                <h5>LAPORAN HASIL LABORATORIUM</h5>
            </center>
            <br>
            <table style="border-spacing: 25px !important;" width="100%">
                <tr>
                    <td>NO REGISTER</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->no_reg) }}</td>

                    <td>DOKTER PENGIRIM</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{$pemeriksaan->pengirim}}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->nik) }}</td>

                    <td>TANGGAL SWAB</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ date('d/m/Y H:i', strtotime($pemeriksaan->tgl_swab)) }}</td>
                </tr>
                <tr>
                    <td>NAMA</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->nama_pasien) }}</td>

                    <td>TANGGAL DITERIMA</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ date('d/m/Y H:i', strtotime($pemeriksaan->tgl_diterima)) }}</td>
                </tr>
                <tr>
                    <td>UMUR</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->umur) }} TAHUN</td>

                    <td>TANGGAL VALIDASI</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ date('d/m/Y H:i', strtotime($pemeriksaan->tgl_validasi)) }}</td>
                </tr>
                <tr>
                    <td>ALAMAT</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->alamat) }}</td>

                    <td>CETAK HASIL</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ date('d/m/Y H:i', strtotime($pemeriksaan->tgl_cetak_hasil)) }}</td>
                </tr>
                
            </table>
            <br>
            <br>
            <center>
                <table width="100%" border="1" cellpadding="">
                    <thead>
                        <tr style="text-align:center;background-color:#8ecdf7">
                            <th>PEMERIKSAAN</th>
                            <th>HASIL</th>
                            <th>HASIL NORMAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pemeriksaan->details !== null)
                            @foreach ($pemeriksaan->details as $key => $item)
                                <tr style="text-align:center">
                                    <td>{{ $item->tipePcr->tipe_pcr }}</td>
                                    <td>{{ $item->hasil }}</td>
                                    <td>{{ $item->tipePcr->nilai_rujukan }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </center>
            <br>
            <div class="keterangan">
                <p class="ml-2">{!!$pemeriksaan->keterangan !!}</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <table style="width:100%;margin-left:10px">
                <tr>
                    <td style="text-align:left">
                        {!! QrCode::size(100)->generate(route('pemeriksaan-pcr.hasil',$pemeriksaan->id_pemeriksaan)) !!}
                    </td>
                    <td style="text-align:right">
                        <p class="text-center">Lumajang, {{ date('d-m-Y', strtotime($pemeriksaan->tgl_diterima)) }}</p>
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

    <script>
        window.print()
    </script>
</body>

</html>
