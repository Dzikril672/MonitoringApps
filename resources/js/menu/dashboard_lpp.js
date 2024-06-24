$(function () {
    "use strict";
    let _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/get-dashboard-bapp',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token: _token
        },
        success: (data) => {
            $('#titleheader').html("Monitoring BAPP tahun " + data.data.tahun);
            var t = $('#dashboardLpp').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    extension: '.xlsx',
                    className: 'btn-sm btn-primary mb-2',
                    text: 'Download Excel',
                    title: 'Monitoring BAPP tahun ' + data.data.tahun
                }],
                destroy: true,
                scrollX: true,
                data: data.data.data,
                columns: [{
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'layanan',
                        render: function (data, type, row) {
                            return "<p style='font-size:12px;'>" + row.layanan + "</p>";
                        }
                    },
                    {
                        data: 'jan',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_jan + "' style='font-size:12px;color:" + row.color_jan + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'feb',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_feb + "' style='font-size:12px;color:" + row.color_feb + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'mar',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_mar + "' style='font-size:12px;color:" + row.color_mar + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'apr',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_apr + "' style='font-size:12px;color:" + row.color_apr + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'mei',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_mei + "' style='font-size:12px;color:" + row.color_mei + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'jun',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_jun + "' style='font-size:12px;color:" + row.color_jun + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'jul',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_jul + "' style='font-size:12px;color:" + row.color_jul + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'agus',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_agus + "' style='font-size:12px;color:" + row.scoloragus + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'sep',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_sep + "' style='font-size:12px;color:" + row.color_sep + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'okt',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_okt + "' style='font-size:12px;color:" + row.color_okt + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'nov',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_nov + "' style='font-size:12px;color:" + row.color_nov + "'>" + data + "</a>";
                        }
                    },
                    {
                        data: 'des',
                        render: function (data, type, row) {
                            return "<a href='javascript:void(0)' class='text-decoration-none btnActionTimeline' slug='" + row.slug_des + "' style='font-size:12px;color:" + row.color_des + "'>" + data + "</a>";
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
        },
        error: function (data) {
            swal("Oppss!", "Terjadi kesalahan, silahkan coba beberapa saat atau hubunggi tim support!", "error");
            $('#btnAddLayananDisabled').addClass('d-none');
            $('#btnAddLayanan').removeClass('d-none');
        }
    });

    get_value();

    function get_value() {
        var blth = $('#bulantahun').val();
        get_lpp_bulanan(blth);
    }

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

    $('#tabledashboardLpp').on('click', '.btnActionTimeline', function () {
        var slug = $(this).attr('slug');
        $.ajax({
            type: 'POST',
            url: '/get-timeline',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                slug: slug,
                _token: _token
            },
            success: (data) => {
                // $('#timelineLpp').html('');
                $('#judulTimeline').html("BAPP " + data.data.layanan.aplikasi.nama_layanan + " Periode " + data.data.layanan.bulan + " - " + data.data.layanan.tahun);
                if (data.pesan === 'SUCCESS') {
                    var html = '';
                    $.each(data.data.timeline, function (index, value) {
                        if (index === 0) {
                            var act = "event2";
                        } else {
                            var act = "";
                        }

                        const d1 = new Date(value.created_at);

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

                        if (value.status.status_tw === 'Selesai') {
                            var link = "<a href='" + value.file_path + "' target='_blank' rel='noopener noreferrer' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left'" +
                                "title='Klik untuk melihat file usulan lampiran'>. <i class='bx bx-file-blank mr-1'></i> File Lampiran</a>"
                        } else {
                            var link = "";
                        }

                        var result2 = formatDate(d1);

                        html += "<li class='event " + act + "' data-date='" + result2 + "'>" +
                            "<h3>" + value.status.status_tw + "</h3>" +
                            "<p>" + value.keterangan + " " + link + ".</p>" +

                            "</li>"
                    });
                    $('#timelineLppTREE').html(html);
                    $('#modalTimeline').modal('show');

                } else if (data.pesan === 'ERROR') {
                    swal("Gagal!", "Bidang baru gagal di tambah!", "error");
                } else {
                    swal("error!", data.pesan, "error");
                }
            },
            error: function (data) {
                swal("Oppss!", "Terjadi kesalahan, silahkan coba beberapa saat atau hubunggi tim support!", "error");
            }
        });
    });
});
