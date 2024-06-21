@extends('layouts.template')
@section('heading')
<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
<link href="assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

<link href="assets/css/style.css" rel="stylesheet" />
<style>
    .btnActionTimeline:hover {
        font-weight: 800;
    }

    .timeline {
        border-left: 3px solid #727cf5;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        /* background: rgba(114, 124, 245, 0.09); */
        margin: 0 auto;
        letter-spacing: 0.2px;
        position: relative;
        line-height: 1.4em;
        font-size: 1.03em;
        padding: 50px;
        list-style: none;
        text-align: left;
        max-width: 75%;
    }

    @media (max-width: 767px) {
        .timeline {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline h1 {
        font-weight: 300;
        font-size: 1.4em;
    }

    .timeline h2,
    .timeline h3 {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .timeline .event {
        border-bottom: 1px dashed #e8ebf1;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline .event {
            padding-top: 30px;
        }
    }

    .timeline .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline .event:before,
    .timeline .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .event:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline .event:after {
        -webkit-box-shadow: 0 0 0 3px #727cf5;
        box-shadow: 0 0 0 3px #727cf5;
        left: -55.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 5px;
    }

    .timeline .event2:after {
        background: #727cf5;
    }

    @media (max-width: 767px) {
        .timeline .event:after {
            left: -31.8px;
        }
    }

    .rtl .timeline {
        border-left: 0;
        text-align: right;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        border-right: 3px solid #727cf5;
    }

    .rtl .timeline .event::before {
        left: 0;
        right: -170px;
    }

    .rtl .timeline .event::after {
        left: 0;
        right: -55.8px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3">
            <div class="col">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Layanan</p>
                                <h4 class="my-1 text-info">{{$totalLayanan}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='bx bxs-category'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">BAPP Selesai</p>
                                <h4 class="my-1 text-success">{{$lppSelesai}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-category'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">BAPP BeLum Selesai</p>
                                <h4 class="my-1 text-danger">{{$lppBelumSelesai}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='bx bxs-category'></i>
                            </div>
                        </div>
                    </div>
                </div>d
            </div>
        </div>
        <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2">
            <div class="col">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">SLA Tercapai <small>(<= 10 Hari)</small>
                                </p>
                                <h4 class="my-1 text-success">{{$ratarataDiBawah}} % </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-quepal text-white ms-auto">
                                <i class='bx bxs-category'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div style="min-height:100px" class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">SLA Tidak Tercapai <small>(> 10 Hari)</small></p>
                                <h4 class="my-1 text-danger">{{$ratarataDiAtas}} % </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='bx bxs-category'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-6">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-header">
                        <b>Status BAPP Belum Selesai</b>
                    </div>
                    <div class="card-body">
                        <table border="0" id="table_fixed">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 25%">Layannan</th>
                                    <th style="width: 30%">Status Terakhir</th>
                                    <th style="width: 30%">Periode</th>
                                </tr>
                            </thead>
                        </table>
                        <div id="contain">
                            <table class="table-bordered" id="table_scroll">
                                <tbody>
                                    @if(count($lppDdanger) > 0)
                                    @foreach($lppDdanger as $key => $d)
                                    <tr>
                                        <td style="width: 5%">{{$loop->iteration}}</td>
                                        <td style="width: 25%">{{$d['aplikasi']['nama_layanan']}}</td>
                                        <td style="width: 30%">{{$d['status']['status_out_tw']}}</td>
                                        <td style="width: 30%">{{$comp->tgl_indo($d->bulan) }} {{$d->tahun}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr style="border: 1px solid #dddddd00;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-header">
                        <b>Status BAPP Bulan Berjalan</b>
                    </div>
                    <div class="card-body">
                        <table border="0" id="table_fixedInfo">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 25%">Layannan</th>
                                    <th style="width: 30%">Status Terakhir</th>
                                    <th style="width: 30%">Periode</th>
                                </tr>
                            </thead>
                        </table>
                        <div id="containInfo">
                            <table class="table-bordered" id="table_scrollInfo">
                                <tbody>
                                    @if(count($lppInfo) > 0)
                                    @foreach($lppInfo as $key => $i)
                                    <tr>
                                        <td style="width: 5%">{{$loop->iteration}}</td>
                                        <td style="width: 25%">{{$i['aplikasi']['nama_layanan']}}</td>
                                        <td style="width: 30%">{{$i['status']['status_out_tw']}}</td>
                                        <td style="width: 30%">{{$comp->tgl_indo($i->bulan)}} {{$i->tahun}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr style="border: 1px solid #dddddd00;">
                                        <td style="width: 5%"></td>
                                        <td style="width: 25%"></td>
                                        <td style="width: 30%"></td>
                                        <td style="width: 30%"></td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--end breadcrumb-->
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="table">
                        <div class="table-responsive">
                            <table id="dashboardLpp" class="table table-striped table-bordered table-hover"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"
                                            style="vertical-align : middle;text-align:center;font-size:12px;"
                                            rowspan="2">No</th>
                                        <th class="text-center"
                                            style="vertical-align : middle;text-align:center;font-size:12px;"
                                            rowspan="2">Layanan</th>
                                        <th class="text-center" colspan="12" style="font-size:20px;" id="titleheader">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size:12px;">Jan</th>
                                        <th class="text-center" style="font-size:12px;">Feb</th>
                                        <th class="text-center" style="font-size:12px;">Mar</th>
                                        <th class="text-center" style="font-size:12px;">Apr</th>
                                        <th class="text-center" style="font-size:12px;">Mei</th>
                                        <th class="text-center" style="font-size:12px;">Jun</th>
                                        <th class="text-center" style="font-size:12px;">Jul</th>
                                        <th class="text-center" style="font-size:12px;">Agus</th>
                                        <th class="text-center" style="font-size:12px;">Sep</th>
                                        <th class="text-center" style="font-size:12px;">Okt</th>
                                        <th class="text-center" style="font-size:12px;">Nov</th>
                                        <th class="text-center" style="font-size:12px;">Des</th>
                                    </tr>
                                </thead>
                                <tbody id="tabledashboardLpp">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="row justify-content-start">
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <input type="month" id="bdaymonth" name="bdaymonth" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info px-5"
                                    onClick="window.location.reload();"><i class="bx bx-refresh mr-1"></i>Atur
                                    Ulang</button>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div id="table">
                        <div class="table-responsive">
                            <table id="dashboardLppBulanan" class="table table-striped table-bordered table-hover"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"
                                            style="font-size:12px;vertical-align : middle;text-align:center;"
                                            rowspan="2">No</th>
                                        <th class="text-center"
                                            style="font-size:12px;vertical-align : middle;text-align:center;"
                                            rowspan="2">Layanan</th>
                                        <th class="text-center" colspan="12" style="font-size:20px;"
                                            id="titleheaderBulanan"> </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" style="font-size:12px;">Colecting data dan dokumen
                                            pendukung</th>
                                        <th class="text-center" style="font-size:12px;">Pembuatan dokumen</th>
                                        <th class="text-center" style="font-size:12px;">Paraf TL ICON+</th>
                                        <th class="text-center" style="font-size:12px;">Tanda tanggan manager ICON+
                                        </th>
                                        <th class="text-center" style="font-size:12px;">Paraf staff PLN</th>
                                        <th class="text-center" style="font-size:12px;">Tanda tanggan manager PLN
                                        </th>
                                        <th class="text-center" style="font-size:12px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tabledashboardLppBulanan">
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
</div>
@endsection

{{-- MODAL --}}
<div class="modal fade" id="modalTimeline" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalTimelineLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTimelineLabel">Timeline Status BAPP</h1>
                <button type="button" onClick="window.location.reload();" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-2">
                    <h2 class="font-weight-light text-center text-muted py-3" id="judulTimeline"></h2>
                </div>
                <div id="">
                    <ul class="timeline" id="timelineLppTREE">

                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="bulantahun" id="bulantahun" value="{{date('Y-m', strtotime(date('Y-m-d') . '- 1 month' ))}}">


@section('js')
<script src="assets/js/jquery.min.js"></script>

<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        
        pageScroll();
        $("#contain").mouseover(function() {
            clearTimeout(my_time);
        }).mouseout(function() {
            pageScroll();
        });
        
        pageScrollInfo();
        $("#containInfo").mouseover(function() {
            clearTimeout(my_timeInfo);
        }).mouseout(function() {
            pageScrollInfo();
        });
        
        getWidthHeader('table_fixed','table_scroll');
        getWidthHeader('table_fixedInfo','table_scrollInfo');

        
    });

    var my_time;
    var my_timeInfo;
    function pageScroll() {
        var objDiv = document.getElementById("contain");
        objDiv.scrollTop = objDiv.scrollTop + 1;  
        if ((objDiv.scrollTop + 100) == objDiv.scrollHeight) {
            objDiv.scrollTop = 0;
        }
        my_time = setTimeout('pageScroll()', 25);
    }
    function pageScrollInfo() {
        var objDiv = document.getElementById("containInfo");
        objDiv.scrollTop = objDiv.scrollTop + 1;  
        if ((objDiv.scrollTop + 100) == objDiv.scrollHeight) {
            objDiv.scrollTop = 0;
        }
        my_timeInfo = setTimeout('pageScrollInfo()', 25);
    }

    function getWidthHeader(id_header, id_scroll) {
        var colCount = 0;
        $('#' + id_scroll + ' tr:nth-child(1) td').each(function () {
            if ($(this).attr('colspan')) {
            colCount += +$(this).attr('colspan');
            } else {
            colCount++;
            }
        });
        
        for(var i = 1; i <= colCount; i++) {
            var th_width = $('#' + id_scroll + ' > tbody > tr:first-child > td:nth-child(' + i + ')').width();
            $('#' + id_header + ' > thead th:nth-child(' + i + ')').css('width',th_width + 'px');
        }
    }
    
</script>
<script src="assets/js/menu/dashboard_lpp.js"></script>

@endsection