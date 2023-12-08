@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Jumlah Surat Masuk Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Surat Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratMasuk }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Surat Keluar Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Surat Keluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratKeluar }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jumlah Surat Bulan ini Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Jumlah Surat Bulan ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratBulanIni }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jumlah Surat tahun 2023 Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Jumlah Surat tahun 2023</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratTahunIni }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Jumlah Surat Bulan ini</h6>                        
                        <div class="text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Surat Masuk
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Surat Keluar
                            </span>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Persentase Surat Bulan ini</h6>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Surat Masuk
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Surat Keluar
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('template/js/demo/chart-bar-demo.js') }}" data-labels="{{ json_encode($labels) }}"
            data-data-surat-masuk="{{ json_encode($dataSuratMasuk) }}"
            data-data-surat-keluar="{{ json_encode($dataSuratKeluar) }}"></script>

            <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}" data-labels="{{ json_encode($labels) }}"
            data-total-surat-masuk="{{ json_encode($totalSuratMasukBulanIni) }}"
            data-total-surat-keluar="{{ json_encode($totalSuratKeluarBulanIni) }}"></script>
        </div>
        
    @endsection
    