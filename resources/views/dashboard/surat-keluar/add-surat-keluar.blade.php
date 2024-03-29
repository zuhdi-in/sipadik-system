@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex">
                <div class="circle-icon">
                    <i class="fa-solid fa-book fa-lg"></i>
                </div>
                <h3 class="title_page">Form Surat Keluar</h3>
            </div>
        </div>
        <div class="mb-4 pt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="">
                <form method="POST" action="{{ route('surat-keluar.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-sm-4 mb-3 mb-lg-0">
                            <label class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}"/>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label class="form-label">Perihal</label>
                            <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}"/>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label">Jenis Surat</label>
                            <select class="form-select form-control" name="jenis_surat_id">
                                <option selected>-- Pilih Jenis Surat --</option>                            
                                @foreach($jenis as $jns)                            
                                    @php $sel = ($jns->id == old('jenis_surat_id')) ? 'selected' : ''; @endphp
                                    <option value="{{ $jns->id }}" {{ $sel}}>{{ $jns->{'nama_jenis'} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}"/>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Penerima</label>
                            <input type="text" name="penerima" class="form-control" value="{{ old('penerima') }}"/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Berkas</label>
                            <input type="file" name="berkas" class="form-control" />
                            <div id="berkasHelp" class="form-text">*Max File : 2 mb</div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <div class="input-group input-group-merge">
                            <a class="btn" title="Kembali" href=" {{ route('surat-keluar.index') }}">
                                <i class='fas fa-fw fa-arrow-left'></i> Kembali
                            </a>
                            &nbsp;
                            <button type="submit" class="btn"
                                style="background-color: #1DC88A; color:white; border-radius:20px;">
                                <i class='fas fa-fw fa-save'></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
