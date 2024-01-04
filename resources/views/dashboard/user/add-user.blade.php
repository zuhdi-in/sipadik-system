@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex">
                <div class="circle-icon">
                    <i class="fa-solid fa-book fa-lg"></i>
                </div>
                <h3 class="title_page">Form User</h3>
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
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf        
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" />
                        </div>

                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" minlength="8" id="passinput"
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
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Role User</label>
                            <select class="form-select form-control" name="type">
                                <option selected>-- Pilih Jenis Surat --</option>                            
                                <option value="1">Staff</option>                            
                                <option value="2">Kepala Sekolah</option>                            
                                
                            </select>
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
