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
                <a class="btn btn-danger btn_print" href="{{ url('dashboard/surat-masuk/export-pdf') }}">
                    <i class="fa-regular fa-file-pdf fa-lg"></i> &nbsp Cetak Laporan
                </a>

                <a class="btn btn-success btn_print" href="{{ url('dashboard/surat-masuk/export-excel') }}">
                    <i class="fa-solid fa-file-csv fa-lg"></i> &nbsp Cetak Laporan
                </a>
            </div>

        </div>
        <form id="filter-form">
            <div class="row justify-content-between mb-4">
                <div class="col-12 col-md-8">
                    <div class="row align-items-end ">
                        <div class="col-6 col-md-4">
                            <label for="startDate" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="endDate" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                        </div>
                        <div class="col mt-2 mt-lg-0">

                            <button id="filter_button" type="submit" class="btn form-control"
                                style="background-color: #1DC88A;color:white; border-radius:100px;">Terapkan</button>
                        </div>
                        <div class="col mt-2 mt-lg-0">
                            <!-- ... Existing filter elements ... -->

                            <button style="background-color: white; border: 0px; color:red; width:50%;"
                                id="clear_filter_button" class="btn form-control btn-danger">Bersihkan</button>
                        </div>
                    </div>
                </div>
                <div style="width: 300px;" class="col-12 col-md-3 mt-4 mt-lg-0">
                    <label for="search">Search:</label>
                    <input type="text" id="search" class="form-control">
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-borderless text-center custom-table align-middle" id="example" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 20px;" class="text-center">Tanggal Surat
                        </th>
                        <th class="text-center">Tanggal Diterima</th>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Perihal</th>
                        <th class="text-center">Pengirim</th>
                        <th class="text-center">Berkas</th>
                        <th class="text-center">Disposisi</th>
                        <th class="text-center">Keterangan</th>
                        <th style="border-top-right-radius: 20px" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->{'tanggal_surat'} ?? '-' }}</td>
                            <td>{{ $row->{'tanggal_diterima'} ?? '-' }}</td>
                            <td>{{ $row->{'nomor_surat'} ?? '-' }}</td>
                            <td>{{ $row->perihal ?? '-' }}</td>
                            <td>{{ $row->pengirim ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ url('dashboard/surat-masuk/unduh', $row->id) }}"
                                        class="btn btn-success btn-sm rounded-circle"
                                        style="width: 35px; height:35px; display: flex; align-items: center; justify-content: center;">
                                        <i class='fas fa-fw fa-download'></i>
                                    </a>
                                </div>
                                <div class="mt-2 d-flex justify-content-center">
                                    <a href="{{ route('surat-masuk.preview', $row->id) }}"
                                        class="btn btn-primary btn-sm rounded-circle"
                                        style="width: 35px; height:35px; display: flex; align-items: center; justify-content: center;"
                                        target="_blank">
                                        <i class='fas fa-fw fa-eye'></i>
                                    </a>
                                </div>
                            </td>




                            <td class="pte">{{ $row->disposisi ?? '-' }}</td>
                            <td class="pte">
                                {{ $row->keterangan ?? '-' }}</td>
                            <td class="text-center">

                                <a class="btn btn-sm dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='fas fa-fw fa-gear fa-lg'></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <form method="POST" action="{{ route('surat-masuk.destroy', $row->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <!-- aksi untuk edit data -->
                                        <a class="dropdown-item btn btn-warning btn-sm"
                                            href="{{ route('surat-masuk.edit', $row->id) }}">
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
