@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-column flex-sm-row mb-4">
            <div class="d-flex">
                <div class="circle-icon">
                    <i class="fa-solid fa-book fa-lg"></i>
                </div>
                <h3 class="title_page">Buku Agenda - Surat Masuk</h3>
            </div>
            <div class="d-flex flex-wrap justify-content-between gap-10 mt-4 mt-lg-0 ">
                <a class="btn btn-success btn_print" href="{{ route('user.create') }}">
                    <i class="fa-solid fa-plus fa-lg"></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless text-center custom-table align-middle" id="example" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 20px;" class="text-center">No
                        </th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th style="border-top-right-radius: 20px" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1; // Initialize the counter outside the loop
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $row->name ?? '-' }}</td>
                            <td>{{ $row->email ?? '-' }}</td>
                            <td class="text-center">

                                <a class="btn btn-sm dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='fas fa-fw fa-gear fa-lg'></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <form method="POST" action="{{ route('user.destroy', $row->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <!-- aksi untuk edit data -->
                                        <a class="dropdown-item btn btn-warning btn-sm"
                                            href="{{ route('user.edit', $row->id) }}">
                                            <i class='fas fa-fw fa-pen mr-2 text-gray-400'></i>&nbsp;Edit Data
                                        </a>
                                        &nbsp;
                                        <!-- aksi untuk hapus data -->
                                        <button type="submit" class="btn btn-danger btn-sm dropdown-item"
                                            onclick="return confirm('Anda Yakin Data akan diHapus?')">
                                            <i class='fas fa-fw fa-trash mr-2 text-gray-400'></i>&nbsp;Hapus Data
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
