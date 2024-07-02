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
                    <div style="height:100%" class="card radius-10 border-start border-0 border-3 border-info bg-gradient-scooter-pink">
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
                    <div style="height:100%" class="card radius-10 border-start border-0 border-3 border-info bg-gradient-scooter">
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
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item" style="position: relative;">
                        <a class="nav-link active" data-toggle="tab" href="#belumselesai" role="tab" style="position: relative;">
                            Belum Selesai
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">{{ $jumlahLppBelum }}</span>
                        </a>
                    </li>
                    <li class="nav-item" style="position: relative;">
                        <a class="nav-link" data-toggle="tab" href="#bulanberjalan" role="tab" style="position: relative;">
                            Bulan Berjalan
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">{{ $jumlahLppBerjalan }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <!-- tab belum selesai -->
                <div class="tab-pane fade show active" id="belumselesai" role="tabpanel">
                    <div class="row mt-1">
                        <div class="col">
                            <form id="searchFormBelum" method="GET">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="text" name="cariBelum" id="cariBelum" class="form-control" 
                                                placeholder="Cari Layanan" value="{{Request('cariBelum')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button type="button" id="btnCariBelum" class="btn btn-primary w-100">
                                                <ion-icon name="search-outline"></ion-icon>
                                                cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="resultContainerBelum">
                        @if(count($lppDdanger) > 0)
                            @foreach($lppDdanger as $key => $d)
                                <ul class="listview image-listview">
                                    <li>
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>{{ $d['aplikasi']['nama_layanan'] }}</b>
                                                    <br>
                                                    <small class="text-muted">{{ $d['status']['status_out_tw'] }}</small>
                                                </div>
                                                <span class="badge bg-belum">{{ $comp->tgl_indo($d->bulan) }} {{ $d->tahun }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <div style="text-align: center;"> Semua Layanan Telah Selesai </div>
                        @endif
                    </div>
                </div>

                <!-- tab bulan berjalan  -->
                <div class="tab-pane fade" id="bulanberjalan" role="tabpanel">
                    <div class="row mt-1">
                        <div class="col">
                            <form id="searchFormBerjalan" method="GET">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="text" name="cariBerjalan" id="cariBerjalan" class="form-control" 
                                                placeholder="Cari Layanan" value="{{ Request('cariBerjalan') }}">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <button type="button" id="btnCariBerjalan" class="btn btn-primary w-100">
                                                <ion-icon name="search-outline"></ion-icon>
                                                cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="resultContainerBerjalan">
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
    </div>
@endsection

@push('myscript')

<script>
    $(document).ready(function() {
        $('#cariBelum').on('keyup', function() {
            let cariBelum = $(this).val();
            
            $.ajax({
                url: '/search-belumselesai',
                type: 'GET',
                data: { cariBelum: cariBelum },
                success: function(response) {
                    $('#resultContainerBelum').html('');
                    if (response.length > 0) {
                        $.each(response, function(key, d) {
                            var namaLayanan = d.aplikasi.nama_layanan;
                            var status = d.status.status_out_tw;
                            let item = `
                                <ul class="listview image-listview">
                                    <li>
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>${namaLayanan}</b>
                                                    <br>
                                                    <small class="text-muted">${status}</small>
                                                </div>
                                                <span class="badge bg-belum">{{ $comp->tgl_indo($d->bulan) }} {{ $d->tahun }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>`;
                            $('#resultContainerBelum').append(item);
                        });
                    } else {
                        $('#resultContainerBelum').html('<div style="text-align: center;">Layanan tidak ada</div>');
                    }
                }
            });         
        });

        $('#btnCariBelum').on('click', function() {
            let cariBelum = $('#cariBelum').val();
            
            $.ajax({
                url: '/search-belumselesai',
                type: 'GET',
                data: { cariBelum: cariBelum },
                success: function(response) {
                    $('#resultContainerBelum').html('');
                    if (response.length > 0) {
                        $.each(response, function(key, d) {
                            var namaLayanan = d.aplikasi.nama_layanan;
                            var status = d.status.status_out_tw;
                            let item = `
                                <ul class="listview image-listview">
                                    <li>
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>${namaLayanan}</b>
                                                    <br>
                                                    <small class="text-muted">${status}</small>
                                                </div>
                                                <span class="badge bg-belum">{{ $comp->tgl_indo($d->bulan) }} {{ $d->tahun }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>`;
                            $('#resultContainerBelum').append(item);
                        });
                    } else {
                        $('#resultContainerBelum').html('<div style="text-align: center;">Layanan tidak ada</div>');
                    }
                }
            });         
        });

        $('#cariBerjalan').on('keyup', function() {
            let cariBerjalan = $(this).val();
            
            $.ajax({
                url: '/search-berjalan',
                type: 'GET',
                data: { cariBerjalan: cariBerjalan },
                success: function(response) {
                    $('#resultContainerBerjalan').html('');
                    if (response.length > 0) {
                        $.each(response, function(key, i) {
                            let item = `
                                <ul class="listview image-listview">
                                    <li>
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>${i.aplikasi.nama_layanan}</b>
                                                    <br>
                                                    <small class="text-muted">${i.status.status_out_tw}</small>
                                                </div>
                                                <span class="badge bg-udah">{{$comp->tgl_indo($i->bulan)}} {{$i->tahun}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>`;
                            $('#resultContainerBerjalan').append(item);
                        });
                    } else {
                        $('#resultContainerBerjalan').html('<div style="text-align: center;">Layanan tidak ada</div>');
                    }
                }
            });
        });

        $('#btnCariBerjalan').on('click', function() {
            let cariBerjalan = $('#cariBerjalan').val();
            
            $.ajax({
                url: '/search-berjalan',
                type: 'GET',
                data: { cariBerjalan: cariBerjalan },
                success: function(response) {
                    $('#resultContainerBerjalan').html('');
                    if (response.length > 0) {
                        $.each(response, function(key, i) {
                            let item = `
                                <ul class="listview image-listview">
                                    <li>
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>${i.aplikasi.nama_layanan}</b>
                                                    <br>
                                                    <small class="text-muted">${i.status.status_out_tw}</small>
                                                </div>
                                                <span class="badge bg-udah">{{$comp->tgl_indo($i->bulan)}} {{$i->tahun}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>`;
                            $('#resultContainerBerjalan').append(item);
                        });
                    } else {
                        $('#resultContainerBerjalan').html('<div style="text-align: center;">Layanan tidak ada</div>');
                    }
                }
            });
        });
    });
</script>

@endpush