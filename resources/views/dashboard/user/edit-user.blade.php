{{-- @extends('layouts.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Data</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">

                    <!-- Form Edit untuk Role Guru -->
                    <form method="POST" action="{{ route('user.update', $row->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputNama">Email</label>
                            <input type="email" class="form-control" id="exampleInputNama" name="email" placeholder=""
                                value="{{ $row->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNama">Username</label>
                            <input type="text" class="form-control" id="exampleInputNama" name="username" placeholder=""
                                value="{{ $row->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNama">Reset Password</label>
                            <input type="password" class="form-control" id="passinput" name="password" placeholder=""
                                value="" minlength="8">
                            <input type="checkbox" onclick="myFunction()">Show Password
                            <script>
                                function myFunction() {
                                    var x = document.getElementById("passinput");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $row->id }}">
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <div class="input-group input-group-merge">
                                <a class="btn btn-info" title="Kembali" href=" {{ route('dashboard') }}">
                                    <i class='fas fa-fw fa-arrow-left'></i> Kembali
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-primary">
                                    <i class='fas fa-fw fa-save'></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex">
                <div class="circle-icon">
                    <i class="fa-solid fa-book fa-lg"></i>
                </div>
                <h3 class="title_page">Form Edit Surat Masuk</h3>
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
                <form method="POST" action="{{ route('user.update', $row->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Nama</label>
                            <input value="{{ $row->name }}" type="text" name="name" class="form-control" />
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input value="{{ $row->email }}" type="email" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Reset Password</label>
                            <input value="" type="password" name="password" minlength="8" id="passinput"
                                class="form-control" />
                            <input type="checkbox" onclick="myFunction()">Show Password
                            <script>
                                function myFunction() {
                                    var x = document.getElementById("passinput");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"></label>
                        <div class="input-group input-group-merge">
                            <a class="btn" title="Kembali" href=" {{ route('dashboard') }}">
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
