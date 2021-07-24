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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data pemeriksaan</h5>
                        <form action="{{ route('pemeriksaan.update', $dataPemeriksaan->id_pemeriksaan) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="no_reg" class="">No Registrasi</label>
                                    <input name="no_reg" id="no_reg" placeholder="No Registrasi" type="text" class="form-control @error('no_reg') is-invalid @enderror" value="{{ old('no_reg', $dataPemeriksaan->no_reg) }}">
                                    @error('no_reg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="pengirim" class="">Pengirim</label>
                                    <input name="pengirim" id="pengirim" placeholder="Pengirim" type="text" class="form-control @error('pengirim') is-invalid @enderror" value="{{ old('pengirim', $dataPemeriksaan->pengirim) }}">
                                    @error('pengirim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="dokter" class="">Dokter</label>
                                    <select name="dokter" id="dokter" class="form-control @error('dokter') is-invalid @enderror">
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($findAllDokter as $item)
                                            <option value="{{ $item->id_dokter }}" {{ ($item->id_dokter == old('dokter', $dataPemeriksaan->id_dokter)) ? 'selected' : '' }} > {{$item->nama_dokter}} </option>
                                        @endforeach
                                    </select>
                                    @error('dokter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="nik" class="">NIK</label>
                                    <input name="nik" id="nik" placeholder="Nama Lengkap" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $dataPemeriksaan->pasien->nik) }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="name" class="">Nama Lengkap</label>
                                    <input name="name" id="name" placeholder="Nama Lengkap" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $dataPemeriksaan->pasien->nama_pasien) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="umur" class="">Umur</label>
                                    <input name="umur" id="umur" placeholder="Umur" type="number" class="form-control @error('umur') is-invalid @enderror" value="{{ old('umur', $dataPemeriksaan->pasien->umur) }}">
                                    @error('umur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="alamat" class="">Alamat</label>
                                    <textarea name="alamat" id="alamat" placeholder="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $dataPemeriksaan->pasien->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="keterangan" class="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" placeholder="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $dataPemeriksaan->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_pemeriksaan" class="">Tanggal</label>
                                    <input name="tgl_pemeriksaan" id="tgl_pemeriksaan" placeholder="No Registrasi" type="date" class="form-control @error('tgl_pemeriksaan') is-invalid @enderror" value="{{ old('tgl_pemeriksaan', date('Y-m-d',strtotime($dataPemeriksaan->tgl_pemeriksaan))) }}">
                                    @error('tgl_pemeriksaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="jam" class="">Jam Pemeriksaan</label>
                                    <input name="jam" id="jam" placeholder="Jam Pemeriksaan" class="form-control @error('jam') is-invalid @enderror" value="{{ old('jam', date('H:i',strtotime($dataPemeriksaan->tgl_pemeriksaan))) }}">
                                    @error('jam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                            <th>Nilai Normal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($dataPemeriksaan->details !== null)
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($dataPemeriksaan->details as $key => $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $no }}</td>
                                                <td>{{ $item->tipe->tipe }}</td>
                                                <td>{{ $item->hasil }}</td>
                                                <td>{{ $item->tipe->nilai_normal }}</td>
                                                <td>
                                                    <div class="form-inline">
                                                        <form action="{{ route('pemeriksaan.detail.destroy', ['detail'=>$item->id_detail,'id_pemeriksaan'=>$dataPemeriksaan->id_pemeriksaan]) }}" method="post">
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
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Detail pemeriksaan</h5>
                                <form action="{{ route('pemeriksaan.store.detail', [$dataPemeriksaan->id_pemeriksaan]) }}" method="post">
                                    @csrf
                                    <div class="position-relative form-group">
                                        <label for="tipe_pemeriksaan" class="">Pemeriksaan</label>
                                        <select name="tipe_pemeriksaan" id="tipe_pemeriksaan" class="form-control @error('pengirim') is-invalid @enderror">
                                            <option value="">-- PEMERIKSAAN --</option>
                                            @foreach ($findAllTipe as $item)
                                                <option value="{{ $item->id_tipe }}" {{ old('tipe_pemeriksaan') == $item->id_tipe ? 'selected' : '' }} > {{$item->tipe}} </option>
                                            @endforeach
                                        </select>
                                        @error('tipe_pemeriksaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="hasil" class="">Hasil</label>
                                        <select name="hasil" id="hasil" class="form-control  @error('hasil') is-invalid @enderror">
                                            <option value="">-- Hasil --</option>
                                            <option value="NON REAKTIF" {{ old('hasil') == 'NON REAKTIF' ? 'selected' : '' }} >NON REAKTIF</option>
                                            <option value="REAKTIF" {{ old('hasil') == 'REAKTIF' ? 'selected' : '' }} >REAKTIF</option>
                                        </select>
                                        @error('hasil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#jam').timepicker({
            uiLibrary: 'bootstrap4',
            format: 'HH:MM'
        });
    </script>
@endsection
