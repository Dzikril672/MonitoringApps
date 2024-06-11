@extends('layouts.master')

@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="imaged w64 rounded">
            </div>
            <div id="user-info" style="color:white;">
                <h2 id="user-name">{{ Auth::user()->name }}</h2>
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
                                <h4 class="my-1 text-info">{{$totalLayanan}}</h4>
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
                                    <h4 class="my-1 text-white">{{$lppBelumSelesai}}</h4>
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
                                    <p class="mb-0 text-white">LPP Selesai</p>
                                    <h4 class="my-1 text-white">{{$lppSelesai}}</h4>
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

            <!-- tablist panel -->
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#belumselesai" role="tab">
                            Belum Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bulanberjalan" role="tab">
                            Bulan Berjalan
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <!-- tab belum selesai -->
                <div class="tab-pane fade show active" id="belumselesai" role="tabpanel">
                    @if(count($lppDdanger) > 0)
                        @foreach($lppDdanger as $key => $d)
                            <ul class="listview image-listview">
                                <li>
                                    <div class="item">
                                        <div class="in">
                                            <div>
                                                <b>{{$d['aplikasi']['nama_layanan']}}</b>
                                                <br>
                                                <small class="text-muted">{{$d['status']['status_out_tw']}}</small>
                                            </div>
                                                <span class="badge bg-belum">{{$comp->tgl_indo($d->bulan) }} {{$d->tahun}}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    @else
                        <div style="text-align: center;"> Semua Layanan Telah Selesai </div>
                    @endif
                </div>

                <!-- tab bulan berjalan  -->
                <div class="tab-pane fade" id="bulanberjalan" role="tabpanel">
                    @if(count($lppInfo) > 0)
                        @foreach($lppInfo as $key => $i)
                            <ul class="listview image-listview">
                                <li>
                                    <div class="item">
                                        <div class="in">
                                            <div>
                                                <b>{{$i['aplikasi']['nama_layanan']}}</b>
                                                <br>
                                                <small class="text-muted">{{$i['status']['status_out_tw']}}</small>
                                            </div>
                                                <span class="badge bg-udah">{{$comp->tgl_indo($i->bulan)}} {{$i->tahun}}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    @else
                        <div style="text-align: center;"> Tidak Ada Layanan Bulan ini </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection