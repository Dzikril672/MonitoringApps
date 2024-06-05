@extends('layouts.master')

@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="imaged w64 rounded">
            </div>
            <div id="user-info">
                <h2 id="user-name">Dzikril Hakim</h2>
                <span id="user-role">Technical Support</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="row">
            <div class="col-12">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Layanan</p>
                                <h4 class="my-1 text-info">50</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <ion-icon name="apps-sharp"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-info bg-gradient-scooter-pink">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">LPP Belum Selesai</p>
                                    <h4 class="my-1 text-white">50</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-info bg-gradient-scooter">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">LPP Berjalan</p>
                                    <h4 class="my-1 text-white">50</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="rekappresensi">
                <h3 style="font-family: Arial, Helvetica, sans-serif;" class="text-info">Status BAPP/LPP Per {{$namaBulan[$bulanIni]}} {{$tahunIni}}</h3>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Belum Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Bulan Berjalan
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content mt-2" style="margin-bottom:100px;">

            <!-- tab belum selesai -->
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>DIGIPROC</b>
                                    <br>
                                    <small class="text-muted">Proses Collecting Data dan Dokumen Pendukung</small>
                                </div>
                                    <span class="badge bg-belum">Juni 2024</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>E-PROC</b>
                                    <br>
                                    <small class="text-muted">Paraf Manager Icon+</small>
                                </div>
                                    <span class="badge bg-belum">April 2024</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- tab bulan berjalan  -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
            <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>DIGIPROC</b>
                                    <br>
                                    <small class="text-muted">Proses Collecting Data dan Dokumen Pendukung</small>
                                </div>
                                    <span class="badge bg-udah">Juni 2024</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>E-PROC</b>
                                    <br>
                                    <small class="text-muted">Paraf Manager Icon+</small>
                                </div>
                                    <span class="badge bg-udah">April 2024</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection