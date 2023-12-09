@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex">
                <div class="circle-icon">
                    <i class="fa-solid fa-book fa-lg"></i>
                </div>
                <h3 class="title_page">Form Surat Masuk</h3>
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
                <form method="POST" action="{{ route('surat-masuk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" />
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Perihal</label>
                            <input type="text" name="perihal" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control" />
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Tanggal Diterima</label>
                            <input type="date" name="tanggal_diterima" class="form-control" />
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Diposisi</label>
                            <input type="text" name="disposisi" class="form-control" />
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
                            <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <div class="input-group input-group-merge">
                            <a class="btn" title="Kembali" href=" {{ route('surat-masuk.index') }}">
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
