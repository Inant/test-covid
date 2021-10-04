@extends('template')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="metismenu-icon fa fa-{{$pageIcon}} icon-gradient bg-arielle-smile">
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
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{session('status')}}
                    </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-times-circle"></i> {{session('error')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-user-plus mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header">List Pemeriksaan PCR
                        <div class="btn-actions-pane-right">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword"
                                        value="{{ Request::get('keyword') }}" placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>No Register</th>
                                    <th>Nama Dokter</th>
                                    <th>Pasien</th>
                                    <th>Tanggal Swab</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Tanggal Validasi</th>
                                    <th>Tanggal Cetak Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $page = Request::get('page');
                                    $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                @endphp
                                @foreach ($pemeriksaan as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{ $no }}</td>
                                        <td>{{ $item->no_reg }}</td>
                                        <td>{{ $item->nama_dokter }}</td>
                                        <td>{{ $item->nama_pasien }}</td>
                                        <td>{{ $item->tgl_swab }}</td>
                                        <td>{{ $item->tgl_diterima }}</td>
                                        <td>{{ $item->tgl_validasi }}</td>
                                        <td>{{ $item->tgl_cetak_hasil }}</td>
                                        <td>
                                            <div class="form-inline">
                                                <a href="{{ route('pemeriksaan-pcr.edit', $item->id_pemeriksaan) }}" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-success btn-md" data-toggle="tooltip" title="Edit" data-placement="top"><span class="fa fa-edit"></span></button>
                                                </a>
                                                <a href="{{ route('pemeriksaan-pcr.show', $item->id_pemeriksaan) }}" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-md" data-toggle="tooltip" title="Detail" data-placement="top"><span class="fa fa-info-circle"></span></button>
                                                </a>
                                                <a href="{{ route('pemeriksaan-pcr.print', $item->id_pemeriksaan) }}" target="_blank" class="mr-2">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-md" data-toggle="tooltip" title="Cetak" data-placement="top"><span class="fa fa-print"></span></button>
                                                </a>
                                                <form action="{{ route('pemeriksaan-pcr.destroy', $item->id_pemeriksaan) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-md" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        {{$pemeriksaan->appends(Request::all())->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
