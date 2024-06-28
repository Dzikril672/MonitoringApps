@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary">
        <div class="pageTitle">Monitoring BAPP/LPP</div>
    </div>

    <div class="row appHeader bg-dasar" style="margin-top: 50px;">
        <div class="col">
            <!-- Your search and filter section -->
            <div class="row mt-2">
                <div class="col-9">
                    <!-- Omitted for brevity -->
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

            <!-- Tabs for months -->
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

            <!-- Search form -->
            <div class="row mt-1">
                <div class="col">
                    <form id="searchForm" action="{{ route('monitoring.index') }}" method="GET">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Layanan" value="{{ request('cari') }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" id="submitSearch" class="btn btn-primary w-100">
                                        <ion-icon name="search-outline"></ion-icon>
                                        Cari
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
    <!-- Body -->
    <div class="section" id="presence-section2" style="margin-top: 270px;">
        <div class="tab-content" style="margin-bottom:100px;">
            @foreach($namaBulanTab as $index => $month)
                <div class="tab-pane fade @if($index == $bulanIni-1) show active @endif" id="{{ strtolower($month) }}" role="tabpanel">
                    @foreach($dataBulan[$index + 1] as $data)
                        <ul class="listview image-listview">
                            <li>
                                <a href="#" id="listCard" class="digi" data-slug="{{ $data->slug }}">
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
    <!-- * Body -->
@endsection

<!-- Modal for Timeline -->
<div class="modal modal-blur fade" id="modal-timeline" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTimelineLabel">Timeline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-2">
                    <h2 class="font-weight-light text-center text-muted py-3" id="judulTimeline"></h2>
                </div>
                <div id="loadTimeline">
                    <!-- Timeline items will be dynamically added here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('myscript')
    <script>
    $(document).ready(function () {
    var currentSlug = null;

    // Handle card click to load timeline
    $(document).on('click', '#listCard', function (e) {
        e.preventDefault();
        var slug = $(this).data('slug');
        currentSlug = slug;
        $('#modal-timeline').modal('show');
        loadTimeline(slug);
    });

    // Function to load timeline based on the slug
    function loadTimeline(slug) {
        $.ajax({
            url: '{{ route('get_timeline') }}',
            type: 'GET',
            data: { slug: slug },
            success: function (response) {
                var timelineHTML = '';

                if (response && response.length > 0) {
                    $.each(response, function (index, item) {
                        var stepNumber = index + 1;
                        var fileAttachment = item.file_name ? '<a href="' + item.file_path + '" class="badge bg-primary text-white" target="_blank">Download Lampiran</a>' : '';

                        timelineHTML += '<div class="card mb-3">';
                        timelineHTML += '  <div class="card-header"><b>Langkah ' + stepNumber + ':</b> ' + item.judul + '</div>';
                        timelineHTML += '  <div class="card-body">';
                        timelineHTML += '    <p class="card-text">' + item.deskripsi + '</p>';
                        timelineHTML += '    <small class="text-muted">Tanggal: ' + item.tanggal + '</small>';
                        timelineHTML += '    <div>' + fileAttachment + '</div>';
                        timelineHTML += '  </div>';
                        timelineHTML += '</div>';
                    });
                } else {
                    timelineHTML = '<p class="text-center">Tidak ada data timeline untuk layanan ini.</p>';
                }

                $('#judulTimeline').text('Timeline untuk ' + slug);
                $('#loadTimeline').html(timelineHTML);
            },
            error: function (xhr, status, error) {
                console.error(error);
                $('#loadTimeline').html('<p class="text-center text-danger">Gagal memuat data timeline.</p>');
            }
        });
    }
});


    </script>
@endpush
