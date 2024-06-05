@extends('layouts.master')



@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Monitoring BAPP/LPP</div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <!-- Body  -->

    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option style="text-align:right" value=""> Tahun </option>
                                @php
                                    $tahunAwal = 2010;
                                    $tahunIni = date('Y');
                                @endphp
                                @for($tahun=$tahunAwal; $tahun <= $tahunIni; $tahun++)
                                    <option style="text-align:right" value="{{ $tahun }}" {{ date( "Y" ) == $tahun ? 'selected' : '' }}> {{ $tahun }} </option>
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
        </div>
    </div>

    <div class="tab-content" style="margin-bottom:100px;">
        @foreach($namaBulanTab as $index => $month)
            <div class="tab-pane fade @if($index == $bulanIni-1) show active @endif" name="" id="{{ strtolower($month) }}" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <a href="/timeline" style="color:black;">
                            <div class="item">
                                <div class="in">
                                    <div>
                                        <b>DIGIPROC</b>
                                        <br>
                                        <small class="text-muted">Proses telah selesai</small>
                                    </div>
                                        <span class="badge bg-success">Selesai</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
    
@endsection

