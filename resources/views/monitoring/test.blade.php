@extends('layouts.master')
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<style>
    /* assets/css/custom.css */

.modal-header {
    background-color: #007bff;
    color: #fff;
    border-bottom: 1px solid #dee2e6;
}

.modal-title {
    font-size: 1.5rem;
}

.modal-body {
    padding: 20px;
}

.timeline {
    position: relative;
    padding: 20px 0;
    list-style: none;
}

.timeline:before {
  content: "";
  display: block;
  position: absolute;
  width: 2px;
  left: 0;
  bottom: 0;
  top: 0;
  background: #000;
  z-index: 1;
  margin-left: 125px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
    padding-left: 40px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 20px;
    height: 20px;
    margin-left: -11px;
    border: 2px solid #007bff;
    border-radius: 50%;
    background-color: #fff;
    z-index: 1;
}

.timeline-item.active::before {
    background-color: #ffc107;
    border-color: #ffc107;
}

.timeline-item .timeline-content {
    padding: 0;
    margin-left: 20px;
}

.timeline-item h3 {
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.timeline-item p {
    margin: 0;
}

.timeline-item a {
    color: #007bff;
}

.timeline-item a:hover {
    text-decoration: underline;
}


</style>

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
                                <a href="#" class="listCard digi" data-slug="{{ $data->slug }}">
                                    <div class="item">
                                        <div class="in">
                                            <div>
                                                <b>{{ $data->aplikasi->nama_layanan }}</b>
                                                <br>
                                                <small class="text-muted">{{ $data->status->status_out_tw }}</small>
                                            </div>
                                            <span class="badge {{ $data->status->status_out_tw == 'Selesai' ? "bg-udah" : "bg-belum" }}">
                                                @if($data->status->status_out_tw == 'Selesai')
                                                    Selesai
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
                <ul id="loadTimeline" class="timeline">
                    <!-- Timeline items will be dynamically added here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


@push('myscript')
    <script>
        $(document).on('click', '.listCard', function (e) {
            $('#closeModalButton').on('click', function () {
                $('#modal-timeline').modal('hide');
            });
            e.preventDefault();
            var slug = $(this).data('slug');
            $.ajax({
                type: 'POST',
                url: '{{ route('get-timeline') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    slug: slug
                },
                success: function (data) {
                    if (data.pesan === 'SUCCESS') {
                        var html = '';
                        $('#judulTimeline').text("BAPP " + data.data.layanan.aplikasi.nama_layanan + " Periode " + data.data.layanan.bulan + " - " + data.data.layanan.tahun);
                        $.each(data.data.timeline, function (index, value) {
                            var act = index === 0 ? "timeline-item active" : "timeline-item";
                            var d1 = new Date(value.created_at);

                            function formatDate(date) {
                                var d = new Date(date),
                                    month = '' + (d.getMonth() + 1),
                                    day = '' + d.getDate(),
                                    year = d.getFullYear();

                                if (month.length < 2)
                                    month = '0' + month;
                                if (day.length < 2)
                                    day = '0' + day;

                                return [day, month, year].join('-');
                            }

                            var link = value.status.status_tw === 'Selesai'
                                ? "<a href='/proxy.php?path=" + encodeURIComponent(value.file_path) + "' target='_blank' rel='noopener noreferrer' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' title='Klik untuk mengunduh file usulan lampiran'><i class='bx bx-file-blank mr-1'></i> File Lampiran</a>"
                                : "";

                            var result2 = formatDate(d1);

                           var result2 = formatDate(d1);

                            html += "<span>" + result2 + "</span>"+
                                "<li class='" + act + "' style='margin-left:125px;' data-date='" + result2 + "'>" +
                                "<div class='timeline-content'>" +
                                "<h3>" + value.status.status_tw + "</h3>" +
                                "<p>" + value.keterangan + " " + link + ".</p>" +
                                "</div>" +
                                "</li>";
                        });
                        $('#loadTimeline').html(html);
                        $('#modal-timeline').modal('show');
                    } else {
                        alert("Gagal memuat data timeline.");
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText + '\n' + xhr.responseText;
                    console.log(errorMessage);
                    alert('Error - ' + errorMessage);
                }
            });
        });
    </script>
@endpush

