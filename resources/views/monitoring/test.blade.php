@extends('layouts.master')

<style>
    .btnActionTimeline:hover {
        font-weight: 800;
    }
</style>

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary">
        <div class="pageTitle">Monitoring BAPP/LPP</div>
    </div>

    <div class="row appHeader bg-dasar" style="margin-top: 50px;">
        <div class="col">
            <div class="row mt-2">
                <div class="col-9">
                    <!-- <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">
                            <ion-icon name="search-outline"></ion-icon>
                            Test
                        </button>
                    </div> -->
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option style="text-align:right" value=""> Tahun </option>
                            @php
                                $tahunAwal = 2010;
                                $tahunIni = date('Y');
                            @endphp
                            @for($tahun = $tahunAwal; $tahun <= $tahunIni; $tahun++)
                                <option style="text-align:right" value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : '' }}> {{ $tahun }} </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <ul class="nav nav-tabs style1" role="tablist" id="myTab">
                            @foreach($namaBulanTab as $index => $month)
                                <li class="nav-item">
                                    <a class="nav-link @if($index == $bulanIni-1) active @endif" data-toggle="tab" href="#{{ strtolower($month) }}" role="tab" aria-selected="@if($index == $bulanIni-1) true @else false @endif">
                                        {{ $month }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col">
                    <form action="#" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Layanan" value="">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <ion-icon name="search-outline"></ion-icon>
                                        cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <!-- Body  -->
    <div class="section" id="presence-section2" style="margin-top: 270px;">
        <div class="tab-content" style="margin-bottom:100px;">
            @foreach($namaBulanTab as $index => $month)
                <div class="tab-pane fade @if($index == $bulanIni-1) show active @endif" id="{{ strtolower($month) }}" role="tabpanel">
                    @foreach($dataBulan[$index + 1] as $data)
                        <ul class="listview image-listview">
                            <li>
                                <a href="#" id="listCard" class="digi">
                                    <div class="item">
                                        <div class="in">
                                            <div>
                                                <b>{{ $data->aplikasi->nama_layanan }}</b>
                                                <br>
                                                <small class="text-muted">{{ $data->status->status_out_tw }}</small>
                                            </div>
                                            <span class="badge {{ $data->status->status_out_tw == 'Selesai' ? "bg-udah" : "bg-belum" }}">
                                                @if($data->status->status_out_tw == 'Selesai')
                                                    selesai
                                                @else
                                                    Proses
                                                @endif    
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

<!-- Modal edit data Departemen -->
<div class="modal modal-blur fade" id="modal-timeline" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modalTimelineLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTimelineLabel">Timeline</h5>   
                <button type="button" onClick="window.location.reload();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-2">
                    <h2 class="font-weight-light text-center text-muted py-3" id="judulTimeline"></h2>
                </div>
                <div id="">
                    <!-- <ul class="timeline" id="loadTimeline"> -->
                        
    <div class="section full mt-2" id="">
        <div class="wide-block">
            <!-- timeline -->
            <div class="timeline timed">
                <div class="item">
                    <span class="time">11:00 AM</span>
                    <div class="dot"></div>
                    <div class="content">
                        <h4 class="title">Call Amanda</h4>
                        <div class="text">Talk about the project</div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">1:30 PM</span>
                    <div class="dot bg-danger"></div>
                    <div class="content">
                        <h4 class="title">Meet up</h4>
                        <div class="text">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">04:40 PM</span>
                    <div class="dot bg-warning"></div>
                    <div class="content">
                        <h4 class="title">Party Night</h4>
                        <div class="text">Get a ticket for party at tonight 9:00 PM</div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">06:00 PM</span>
                    <div class="dot bg-info"></div>
                    <div class="content">
                        <h4 class="title">New Release</h4>
                        <div class="text">Export the version 2.3</div>
                    </div>
                </div>
            </div>
            <!-- * timeline -->
        </div>
    </div>


                    <!-- </ul> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="bulantahun" id="bulantahun" value="{{date('Y-m', strtotime(date('Y-m-d') . '- 1 month' ))}}">

@push('myscript')
    <script>
        $(document).ready(function(){
            // Menambahkan event click handler untuk elemen dengan id listCard
            $(document).on('click', '#listCard', function() {
                $("#modal-timeline").modal("show");
            });
            $('button[type="submit"]').click(function(event) {
                event.preventDefault(); // Mencegah form submit
                alert();
            });
        });
        

    </script>
@endpush
