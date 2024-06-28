@extends('layouts.master')
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

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
                <div id="loadTimeline">
                    <!-- Timeline items will be dynamically added here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('myscript')
    <script>
                $("#bdaymonth").change(function () {
                var blth = $("#bdaymonth").val();
                get_lpp_bulanan(blth);
                    });

            function get_lpp_bulanan(blth) {
                var sblth = blth.split("-");
                var lbulan = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ];
                $.ajax({
                    type: 'POST',
                    url: '/get-bapp-bulanan',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        bulan: sblth[1],
                        tahun: sblth[0],
                        _token: _token
                    },
                    success: (data) => {
                        if (data.pesan === 'SUCCESS') {
                            $('#titleheaderBulanan').html("Monitoring Laporan Pelaksanaan Pekerjaan (BAPP) " + lbulan[parseInt(sblth[1]) - 1] + "-" + sblth[0]);
                            var t = $('#dashboardLppBulanan').DataTable({
                                dom: 'Blfrtip',
                                buttons: [{
                                    extend: 'excelHtml5',
                                    extension: '.xlsx',
                                    className: 'btn-sm btn-primary mb-2',
                                    text: 'Download Excel',
                                    title: 'Monitoring Laporan Pelaksanaan Pekerjaan (BAPP) ' + lbulan[data[1]]
                                }],
                                destroy: true,
                                scrollX: true,
                                data: data.data,
                                columns: [{
                                        "data": null,
                                        "orderable": false,
                                        "searchable": false,
                                        "render": function (data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1;
                                        }
                                    },
                                    {
                                        data: 'name',
                                        render: function (data, type, row) {
                                            return "<p style='font-size:12px;'>" + row.name + "</p>";
                                        }
                                    },
                                    {
                                        data: 'data.step2',
                                        render: function (data, type, row) {
                                            if (row.data.step2 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal2 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step3',
                                        render: function (data, type, row) {
                                            if (row.data.step3 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal3 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step4',
                                        render: function (data, type, row) {
                                            if (row.data.step4 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal4 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step5',
                                        render: function (data, type, row) {
                                            if (row.data.step5 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal5 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step6',
                                        render: function (data, type, row) {
                                            if (row.data.step6 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal6 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step7',
                                        render: function (data, type, row) {
                                            if (row.data.step7 === 'cheked') {
                                                var render = "<div class='font-30 text-primary text-center'><i class ='fadeIn animated bx bx-check'></i><p class='text-center' style='font-size:12px;'>" + row.data.tanggal7 + "</p></div>";
                                            } else {
                                                var render = "";
                                            }
                                            return render;
                                        }
                                    },
                                    {
                                        data: 'data.step8',
                                        render: function (data, type, row) {
                                            var render = "<p class='font-10 " + row.warna + " text-center'>" + data + "</p><p class='text-center' style='font-size:12px;'>" + row.data.tanggal8 + "</p>";
                                            return render;
                                        }
                                    },
                                ],
                                "order": [
                                    [1, 'asc']
                                ]
                            });
                            t.on('order.dt search.dt', function () {
                                let i = 1;

                                t.cells(null, 0, {
                                    search: 'applied',
                                    order: 'applied'
                                }).every(function (cell) {
                                    this.data(i++);
                                });
                            }).draw();
                        } else if (data.pesan === 'ERROR') {
                            swal("Gagal!", "Layanan Aplikasi baru gagal di tambah!", "error");
                        } else {
                            swal("Info!", data.pesan, "info")
                                .then((value) => {
                                    location.reload();
                                });
                        }
                    },
                    error: function (data) {
                        swal("Oppss!", "Terjadi kesalahan, silahkan coba beberapa saat atau hubunggi tim support!", "error");
                        $('#btnAddLayananDisabled').addClass('d-none');
                        $('#btnAddLayanan').removeClass('d-none');
                    }
                });
            }
        $(document).on('click', '.listCard', function (e) {
            $('#closeModalButton').on('click', function () {
                $('#modal-timeline').modal('hide');
            });
            e.preventDefault();
            var slug = $(this).data('slug');
            $.ajax({
                type: 'POST',
                url: '{{ route('get_timeline') }}',
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
                            var act = index === 0 ? "event2" : "";
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

                            html += "<li class='event " + act + "' data-date='" + result2 + "'>" +
                                "<h3>" + value.status.status_tw + "</h3>" +
                                "<p>" + value.keterangan + " " + link + ".</p>" +
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
