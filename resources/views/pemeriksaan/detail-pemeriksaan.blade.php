@extends('template')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="metismenu-icon fa fa-{{ $pageIcon }} icon-gradient bg-arielle-smile">
                        </i>
                    </div>
                    <div>
                        {{ $pageTitle }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- {!! QrCode::size(100)->generate(url('pemeriksaan/'.$pemeriksaan->id_pemeriksaan)); !!} --}}
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Data Pasien</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Tanggal Pemeriksaan: <span class="text-capitalize"> {{$pemeriksaan->format_tgl_pemeriksaan}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        NIK: <span class="text-capitalize alert alert-primary"> {{$pemeriksaan->pasien->nik}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        Nama: <span class="text-capitalize"> {{$pemeriksaan->pasien->nama_pasien}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        Umur: <span class="text-capitalize"> {{$pemeriksaan->pasien->umur}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        Alamat: <span class="text-capitalize"> {{$pemeriksaan->pasien->alamat}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        Pengirim: <span class="text-capitalize"> {{$pemeriksaan->pengirim}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        No Register: <span class="text-capitalize"> {{$pemeriksaan->no_reg}} </span>
                                    </li>
                                    <li class="list-group-item">
                                        Dokter: <span class="text-capitalize"> {{ $pemeriksaan->dokter->nama_dokter}} </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Detail Pemeriksaan</h5>
                                <a href="{{ route('pemeriksaan.print', $pemeriksaan->id_pemeriksaan) }}">
                                    <button class="btn btn-lg btn-warning"> <i class="fa fa-print mr-2"></i>{{$btnRight['text_print']}}</button>
                                </a>
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                            <th>Nilai Normal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pemeriksaan->details !== null)
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($pemeriksaan->details as $key => $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $no }}</td>
                                                <td>{{ $item->tipe->tipe }}</td>
                                                <td>{{ $item->hasil }}</td>
                                                <td>{{ $item->tipe->nilai_normal }}</td>
                                            </tr>
                                            @php
                                                $no++
                                            @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
