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
                        <form action="{{ route('pemeriksaan-pcr.tambah.pemeriksaan') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="no_reg" class="">No Registrasi</label>
                                    <input name="no_reg" id="no_reg" placeholder="No Registrasi" type="text" class="form-control @error('no_reg') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['no_reg'] : '' }}">
                                    @error('no_reg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="pengirim" class="">Pengirim</label>
                                    <input name="pengirim" id="pengirim" placeholder="Pengirim" type="text" class="form-control @error('pengirim') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['pengirim'] : '' }}">
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
                                            <option value="{{ $item->id_dokter }}" {{ ($dataPemeriksaan != null && $dataPemeriksaan['dokter'] == $item->id_dokter) ? 'selected' : '' }} > {{$item->nama_dokter}} </option>
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
                                    <input name="nik" id="nik" placeholder="NIK" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['nik'] : '' }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="name" class="">Nama Lengkap</label>
                                    <input name="name" id="name" placeholder="Nama Lengkap" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['name'] : '' }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="umur" class="">Umur</label>
                                    <input name="umur" id="umur" placeholder="Umur" type="number" class="form-control @error('umur') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['umur'] : '' }}">
                                    @error('umur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="alamat" class="">Alamat</label>
                                    <textarea name="alamat" id="alamat" placeholder="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['alamat'] : '' }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_swab" class="">Tanggal Swab</label>
                                    <input name="tgl_swab" id="tgl_swab" placeholder="Tanggal Swab" type="datetime-local" class="form-control @error('tgl_swab') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['tgl_swab'] : '' }}">
                                    @error('tgl_swab')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_diterima" class="">Tanggal Diterima</label>
                                    <input name="tgl_diterima" id="tgl_diterima" placeholder="Tanggal Diterima" type="datetime-local" class="form-control @error('tgl_diterima') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['tgl_diterima'] : '' }}">
                                    @error('tgl_diterima')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_validasi" class="">Tanggal Validasi</label>
                                    <input name="tgl_validasi" id="tgl_validasi" placeholder="Tanggal Validasi" type="datetime-local" class="form-control @error('tgl_validasi') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['tgl_validasi'] : '' }}">
                                    @error('tgl_validasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_cetak_hasil" class="">Tanggal Cetak Hasil</label>
                                    <input name="tgl_cetak_hasil" id="tgl_cetak_hasil" placeholder="Tanggal Cetak Hasil" type="datetime-local" class="form-control @error('tgl_cetak_hasil') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['tgl_cetak_hasil'] : '' }}">
                                    @error('tgl_cetak_hasil')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-8">
                                    <label for="keterangan" class="">Keterangan</label>
                                    <textarea name="keterangan" class="ck-editor" placeholder="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['keterangan'] : "
                                        <h4>Interpretasi Hasil</h4>
                                        <ul>
                                        <li>
                                        Hasil Positif</li>
                                        <ul>
                                            <li>Menunjukan adanya material genetik RNA SARS-COV-2 pada spesimen yang diperiksa. Mohon untuk menghubungi Dokter atau Fasilitas Kesehatan terdekat apalagi mengalami gejala klinis atau kontak dengan pasien terinfeksi setelah pemeriksaan. Pemeriksaan ulang berdasarkan rekomendasi Dokter.</li>
                                        </ul>
                                        <li>
                                        Hasil Negatif</li>
                                        <ul>
                                        <li>
                                        Menunjukan tidak terdeteksi material genetik RNA SARS-COV-2 didalam spesimen atau kadar spesimen belum dapat terdeteksi oleh alat iiPCR.</li>
                                        </ul>
                                        </ul>" }}</textarea>
                                    @error('keterangan')
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
                                            <th>Nilai Rujukan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($detailPemeriksaan !== null)
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($detailPemeriksaan as $key => $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $no }}</td>
                                                <td>{{ $item['pemeriksaan'] }}</td>
                                                <td>{{ $item['hasil'] }}</td>
                                                <td>{{ $item['nilai_rujukan'] }}</td>
                                                <td>
                                                    <div class="form-inline">
                                                        <form action="{{ route('pemeriksaan-pcr.hapus.detail', $key) }}" method="post">
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
                                <form action="{{ route('pemeriksaan-pcr.tambah.detail') }}" method="post">
                                    @csrf
                                    <div class="position-relative form-group">
                                        <label for="tipe_pcr" class="">Pemeriksaan</label>
                                        <select name="tipe_pcr" id="tipe_pcr" class="form-control @error('pengirim') is-invalid @enderror">
                                            <option value="">-- PEMERIKSAAN --</option>
                                            @foreach ($findAllTipe as $item)
                                                <option value="{{ $item->id_tipe }}" {{ old('tipe_pcr') == $item->id_tipe ? 'selected' : '' }} > {{$item->tipe_pcr}} </option>
                                            @endforeach
                                        </select>
                                        @error('tipe_pcr')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="hasil" class="">Hasil</label>
                                        <select name="hasil" id="hasil" class="form-control  @error('hasil') is-invalid @enderror">
                                            <option value="">-- Hasil --</option>
                                            <option value="NEGATIF" {{ old('hasil') == 'NEGATIF' ? 'selected' : '' }} >NEGATIF</option>
                                            <option value="POSITIF" {{ old('hasil') == 'POSITIF' ? 'selected' : '' }} >POSITIF</option>
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
                <div class="mb-3">
                    <form action="{{ route('pemeriksaan-pcr.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menyimpan semua ?") }}') ? this.parentElement.submit() : ''">Simpan Semua</button>
                    </form>
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
