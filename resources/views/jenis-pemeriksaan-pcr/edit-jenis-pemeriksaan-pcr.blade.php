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
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Jenis Pemeriksaan PCR</h5>
                        <form action="{{ route('jenis-pemeriksaan-pcr.update', $jenisPemeriksaan->id_tipe) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="tipe_pcr" class="">Jenis Pemeriksaan</label>
                                <input name="tipe_pcr" id="tipe_pcr" placeholder="Jenis Pemeriksaan" type="text" class="form-control @error('tipe_pcr') is-invalid @enderror" value="{{old('tipe_pcr', $jenisPemeriksaan->tipe_pcr)}}">
                                @error('tipe_pcr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="nilai_rujukan" class="">Nilai Rujukan</label>
                                <input name="nilai_rujukan" id="nilai_rujukan" placeholder="Jenis Pemeriksaan" type="text" class="form-control @error('nilai_rujukan') is-invalid @enderror" value="{{old('nilai_rujukan', $jenisPemeriksaan->nilai_rujukan)}}">
                                @error('nilai_rujukan')
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
@endsection
