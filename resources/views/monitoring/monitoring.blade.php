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
    margin-left: 123px;
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
        border-color: #fff;
    }

    .timeline-item.revision::before {
        border-color: #ff0000; /* Warna merah untuk revisi */
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
            <div class="row mt-2">
                <div class="col-6"></div>
                <div class="col-6">   
                    <div class="tahun-container">
                        <label for="pilih-tahun" class="tahun-label">Tahun :</label>
                        <select name="pilih-tahun" id="pilih-tahun" class="form-control" style="width:50%;">
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

            <div class="row mt-1">
                <div class="col">
                    <form id="searchForm" method="GET">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-8" style="padding-left: 0px !important;">
                                <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Layanan" value="">
                            </div>

                            <div class="col-4" style="padding-right: 0px !important;">
                                <button type="button" id="btnCari" class="btn btn-primary w-100">
                                    <ion-icon name="search-outline"></ion-icon>
                                    cari
                                </button>
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
    <div class="section" id="presence-section2" style="margin-top: 280px;">
        <div class="tab-content" style="margin-bottom:100px;">
            @foreach($namaBulanTab as $index => $month)
                <div class="tab-pane fade @if($index == $bulanIni-1) show active @endif" id="{{ strtolower($month) }}" role="tabpanel">
                    <div id="resultCari{{ $index+1 }}">
                        @foreach($dataBulan[$index + 1] as $data)
                            <ul class="listview image-listview">
                                <li>
                                    <a href="#" id="listCard" class="listCard digi" data-slug="{{$data -> slug}}">
                                        <div class="item">
                                            <div class="in">
                                                <div>
                                                    <b>{{ $data->aplikasi->nama_layanan }}</b>
                                                    <br>
                                                    <small class="text-muted">{{ $data->status->status_out_tw }}</small>
                                                </div>
                                                <span class="badge {{ $data->status->status_out_tw == 'Selesai' ? "bg-udah" : "bg-belum" }}">
                                                    {{ $data->status->status_out_tw == 'Selesai' ? 'Selesai' : 'Proses' }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('monitoring.timeline')

@endsection

@push('myscript')
    <script>
        function getMonthName(monthNumber) {
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            return monthNames[monthNumber - 1];
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#pilih-tahun').on('change', function() {
                var tahunSelected = $(this).val();
                var cari = $('#cari').val();
                // console.log('Tahun yang dipilih:', tahunSelected);
                // console.log('Data yang dipilih:', cari);

                $.ajax({
                    url: '/getDataByYear',
                    type: 'POST',
                    dataType: "json",
                    data: { 
                        tahun: tahunSelected,
                        cari: cari
                     },
                    success: function(response) {
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html(''); // Kosongkan isi #resultCari untuk setiap bulan
                        });

                        if (Object.keys(response).length > 0) {
                            $.each(response, function(bulan, dataBulan) {
                                if (dataBulan.length > 0) {
                                    $.each(dataBulan, function(key, data) {
                                        let namaLayanan = data.aplikasi.nama_layanan;
                                        let statusTW = data.status.status_out_tw;
                                        let monthId = `resultCari${bulan}`;

                                        let item = `
                                            <ul class="listview image-listview">
                                                <li>
                                                    <a href="#" class="listCard digi" data-slug="${data.slug}">
                                                        <div class="item">
                                                            <div class="in">
                                                                <div>
                                                                    <b>${namaLayanan}</b>
                                                                    <br>
                                                                    <small class="text-muted">${statusTW}</small>
                                                                </div>
                                                                <span class="badge ${statusTW === 'Selesai' ? "bg-udah" : "bg-belum"}">
                                                                    ${statusTW === 'Selesai' ? 'Selesai' : 'Proses'}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>`;
                                        // console.log(monthId, item);
                                        $(`#${monthId}`).append(item); // Tambahkan item baru ke dalam ID yang sesuai
                                    });
                                } else {
                                    let monthId = `resultCari${bulan}`;
                                    $(`#${monthId}`).html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                                }
                            });
                        } else {
                            $('.tab-pane').each(function() {
                                $(this).find('[id^=resultCari]').html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html('<div style="text-align: center; color: red;">Terjadi kesalahan saat mengambil data. Silakan coba lagi.</div>');
                        });
                    }
                });
            });


            $('#btnCari').on('click', function() {
                var tahunSelected = $('#pilih-tahun').val();
                var cari = $('#cari').val();
                // console.log('Tahun yang dipilih:', tahunSelected);
                // console.log('Tahun yang dipilih:', cari);

                $.ajax({
                    url: '/getDataByYear',
                    type: 'POST',
                    dataType: "json",
                    data: { 
                        tahun: tahunSelected,
                        cari: cari
                     },
                    success: function(response) {
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html(''); // Kosongkan isi #resultCari untuk setiap bulan
                        });

                        if (Object.keys(response).length > 0) {
                            $.each(response, function(bulan, dataBulan) {
                                if (dataBulan.length > 0) {
                                    $.each(dataBulan, function(key, data) {
                                        let namaLayanan = data.aplikasi.nama_layanan;
                                        let statusTW = data.status.status_out_tw;
                                        let monthId = `resultCari${bulan}`;

                                        let item = `
                                            <ul class="listview image-listview">
                                                <li>
                                                    <a href="#" class="listCard digi" data-slug="${data.slug}">
                                                        <div class="item">
                                                            <div class="in">
                                                                <div>
                                                                    <b>${namaLayanan}</b>
                                                                    <br>
                                                                    <small class="text-muted">${statusTW}</small>
                                                                </div>
                                                                <span class="badge ${statusTW === 'Selesai' ? "bg-udah" : "bg-belum"}">
                                                                    ${statusTW === 'Selesai' ? 'Selesai' : 'Proses'}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>`;
                                        // console.log(monthId, item);
                                        $(`#${monthId}`).append(item); // Tambahkan item baru ke dalam ID yang sesuai
                                    });
                                } else {
                                    let monthId = `resultCari${bulan}`;
                                    $(`#${monthId}`).html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                                }
                            });
                        } else {
                            $('.tab-pane').each(function() {
                                $(this).find('[id^=resultCari]').html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html('<div style="text-align: center; color: red;">Terjadi kesalahan saat mengambil data. Silakan coba lagi.</div>');
                        });
                    }
                });
            });

            $('#cari').on('keyup', function() {
                var tahunSelected = $('#pilih-tahun').val();
                var cari = $(this).val();
                // console.log('Tahun yang dipilih:', tahunSelected);
                // console.log('Tahun yang dipilih:', cari);

                $.ajax({
                    url: '/getDataByYear',
                    type: 'POST',
                    dataType: "json",
                    data: { 
                        tahun: tahunSelected,
                        cari: cari
                     },
                    success: function(response) {
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html(''); // Kosongkan isi #resultCari untuk setiap bulan
                        });

                        if (Object.keys(response).length > 0) {
                            $.each(response, function(bulan, dataBulan) {
                                if (dataBulan.length > 0) {
                                    $.each(dataBulan, function(key, data) {
                                        let namaLayanan = data.aplikasi.nama_layanan;
                                        let statusTW = data.status.status_out_tw;
                                        let monthId = `resultCari${bulan}`;

                                        let item = `
                                            <ul class="listview image-listview">
                                                <li>
                                                    <a href="#" class="listCard digi" data-slug="${data.slug}">
                                                        <div class="item">
                                                            <div class="in">
                                                                <div>
                                                                    <b>${namaLayanan}</b>
                                                                    <br>
                                                                    <small class="text-muted">${statusTW}</small>
                                                                </div>
                                                                <span class="badge ${statusTW === 'Selesai' ? "bg-udah" : "bg-belum"}">
                                                                    ${statusTW === 'Selesai' ? 'Selesai' : 'Proses'}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>`;
                                        // console.log(monthId, item);
                                        $(`#${monthId}`).append(item); // Tambahkan item baru ke dalam ID yang sesuai
                                    });
                                } else {
                                    let monthId = `resultCari${bulan}`;
                                    $(`#${monthId}`).html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                                }
                            });
                        } else {
                            $('.tab-pane').each(function() {
                                $(this).find('[id^=resultCari]').html('<div style="text-align: center;">Tidak Ada Layanan</div>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        $('.tab-pane').each(function() {
                            $(this).find('[id^=resultCari]').html('<div style="text-align: center; color: red;">Terjadi kesalahan saat mengambil data. Silakan coba lagi.</div>');
                        });
                    }
                });
            });
        });

        $(document).on('click', '.listCard', function (e) {
            $('#closeModalButton').on('click', function () {
                $('#modal-timeline').modal('hide');
            });
            e.preventDefault();
            var slug = $(this).data('slug');
            $.ajax({
                type: 'POST',
                url: '{{ route('get-timeline.monitoring') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    slug: slug
                },
                success: function (data) {
                    if (data.pesan === 'SUCCESS') {
                        var html = '';
                        var statusCounts = {}; // Counter for all statuses

                        

                        var layanan = data.data.layanan;
                        var bulanNama = getMonthName(parseInt(layanan.bulan));
                        $('#judulTimeline').text("BAPP " + layanan.aplikasi.nama_layanan + " Periode " + bulanNama + " - " + layanan.tahun);

                        // Count occurrences of each status
                        $.each(data.data.timeline, function (index, value) {
                            var status = value.status.status_tw;
                            if (statusCounts[status]) {
                                statusCounts[status]++;
                            } else {
                                statusCounts[status] = 1;
                            }
                        });

                        // Build HTML and apply classes based on statusCounts
                        $.each(data.data.timeline, function (index, value) {
                            var status = value.status.status_tw;
                            var d1 = new Date(value.created_at);

                            if (value.paraf?.created_at != null) {
                                var d2 = new Date(value.paraf.created_at);
                            }

                            function formatDate(date) {
                                var d = new Date(date.getTime()+date.getTimezoneOffset()*60000),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear(),
                                hours = '' + d.getHours(),
                                minutes = '' + d.getMinutes(),
                                seconds = '' + d.getSeconds();

                                if (month.length < 2) month = '0' + month;
                                if (day.length < 2) day = '0' + day;
                                if (hours.length < 2) hours = '0' + hours;
                                if (minutes.length < 2) minutes = '0' + minutes;
                                if (seconds.length < 2) seconds = '0' + seconds;

                                return {
                                    date: [day, month, year].join('-'),
                                    time: [hours, minutes, seconds].join(':')
                                };
                            }

                            var link = status === 'Selesai'
                                ? "<a href='/proxy.php?path=" + encodeURIComponent(value.file_path) + "' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' title='Klik untuk mengunduh file usulan lampiran'><i class='bx bx-file-blank mr-1'></i> File Lampiran BAPP</a> <br> <a href='/proxy.php?path=" + encodeURIComponent(value.file_path_lpp) + "' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' title='Klik untuk mengunduh file usulan lampiran'><i class='bx bx-file-blank mr-1'></i> File Lampiran LPP</a>"
                                : "";


                            var formatted = formatDate(d1);
                            var formattedDate = formatted.date + ' ' + formatted.time;

                            if(d2 != null){
                                var formatted2 = formatDate(d2);
                                var formattedDate2 = formatted2.date + ' ' + formatted2.time;
                            }

                            // Determine class for timeline item
                            var act = "timeline-item";
                            if (statusCounts[status] > 1) {
                                act += " timeline-item-red";
                            } else {
                                act += " timeline-item-blue";
                            }

                            if (index === 0) {
                                act += " active";
                            }

                            // Determine class for date and time
                            var dateClass = statusCounts[status] > 1 ? 'text-danger' : '';
                            var timeClass = statusCounts[status] > 1 ? 'text-danger' : '';
                            var Revision  = statusCounts[status] > 1 ? 'text-danger !important' : '';


                            // Menggabungkan hasil ke dalam HTML
                            html += "<span class='" + dateClass + "'>" + formatted.date + "</span><br>" +
                                    "<span class='" + timeClass + "'>" + formatted.time + "</span>" +
                                    "<li class='" + act + "' style='margin-left:125px;' data-date='" + formattedDate + "'>" +
                                    "<div class='timeline-content "+ Revision +"'>" +
                                    "<h3 class='" + Revision + "'>" + status + "</h3>" +
                                    "<p>" + value.keterangan + " " + link + ".</p>" ;
                                    // Kondisi untuk menampilkan ket_timeline hanya pada status yang sesuai
                                    if(d2 != null){
                                        if (value.status_id === value.paraf.status_id) {
                                            html += "<dl style='margin-left:20px'>"+
                                                "<small>" + value.paraf.ket_timeline + " " + link + ".</small>"+"<br>"+
                                                "<small>"+"("+ formattedDate2 +")"+"</small>"+"</dl>"
                                                ;
                                        }
                                    }
                                    html += "</div></li>";
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

