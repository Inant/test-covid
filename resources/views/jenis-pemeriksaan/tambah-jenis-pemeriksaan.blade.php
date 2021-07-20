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
                        <h5 class="card-title">Tambah Jenis Pemeriksaan</h5>
                        <form action="{{ route('jenis-pemeriksaan.store') }}" method="post">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="tipe" class="">Jenis Pemeriksaan</label>
                                <input name="tipe" id="tipe" placeholder="Jenis Pemeriksaan" type="text" class="form-control @error('tipe') is-invalid @enderror" value="{{old('tipe')}}">
                                @error('tipe')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="position-relative form-group">
                                <label for="nilai_normal" class="">Nilai Normal</label>
                                <select name="nilai_normal" id="nilai_normal" class="form-control @error('nilai_normal') is-invalid @enderror">
                                  <option value="">--Nilai Normal--</option>
                                  <option value="NON REAKTIF" {{old('nilai_normal') == 'NON REAKTIF' ? 'selected' : ''}}>NON REAKTIF</option>
                                  <option value="REAKTIF" {{old('nilai_normal') == 'REAKTIF' ? 'selected' : ''}}>REAKTIF</option>
                                </select>
                                @error('nilai_normal')
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
