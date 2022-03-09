<section class="content" style="margin:-40px 0 0 0 ;">
    <div class="row title-content bg-warning m-3 p-2">
        <div class="col-12">
            <h5>List Data Proses Pengajuan Training</h5>
        </div>
    </div>
    <div class="row m-3 pb-3 border-bottom border-warning border-3">
        <div class="col-12">
            <div class="row">
                <label class="col-sm-3 col-form-label">Status Data Training</label>
                <div class="col-sm-4">
                    <select id="status_data" name="status_data" class="form-select" aria-label="Default select example">
                        <option value="0" selected>--- Pilih Status ---</option>
                        <?php foreach ($status_data as $status) : ?>
                            <option value="<?= $status->id_status_data ?>"><?= $status->status_data ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button id="cari" class="btn btn-warning">Cari</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content_pengajuan">
        <div class="row w-100">
            <div class="col-md-12 text-center">
                <strong class="border-bottom border-2 border-dark">Pengajuan Budget Training</strong>
            </div>
        </div>
        <div class="table-content m-3">
            <table id="proses_pengajuan_training" class="table table-bordered align-middle">
                <thead>
                    <tr class="text-center bg-info">
                        <th scope="row">No</th>
                        <th> No. MD</th>
                        <th>Perihal</th>
                        <th>Dari</th>
                        <th>Tgl MD</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Durasi</th>
                        <th>Kelompok Training</th>
                        <th>SLA</th>
                        <th>Approve Detail Budget</th>
                        <th>Act</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="content_realisasi">
        <div class="row w-100">
            <div class="col-md-12 text-center">
                <strong class="border-bottom border-2 border-dark">Data Realisasi Biaya Training</strong>
            </div>
        </div>
        <div class="table-content m-3">
            <table id="table_realisasi" class="table display table-bordered align-middle">
                <thead class="text-center tb-md">
                    <tr>
                        <th scope="row">No</th>
                        <th>No. MD</th>
                        <th>Perihal</th>
                        <th>Dari</th>
                        <th>Tgl MD</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Durasi</th>
                        <th>Budget</th>
                        <th>Realisasi</th>
                        <th>Selisih</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


</section>

<script>
    //    function status(){
    //             statusData = $('select[name=status_data] option').filter(':selected').val()
    //             // alert(statusData);
    //             default_dt(statusData);
    //         }
    $(document).ready(function() {
        $('#loader').hide();
        $(".content_realisasi").hide()
        statusData = '';
        default_dt(statusData);

        function default_dt(statusData) {
            var table = $('#proses_pengajuan_training').DataTable({
                language: {
                    searchPlaceholder: "No. MD"
                },
                "destroy": true,
                "searching": true,
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": false, // Set true agar bisa di sorting
                "order": [
                    [0, 'asc']
                ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax": {
                    "url": "<?= base_url('Program_Training/Proses_pengajuan_training_c/view_data_query/'); ?>", // URL file untuk proses select datanya
                    "type": "POST",
                    "data": {
                        'status_non': statusData
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ], // Combobox Limit
                "columns": [{
                        "data": 'nomor_pengajuan',
                        "sortable": false, // !!! id_sort
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "nomor_pengajuan"
                    },
                    {
                        "data": "perihal"
                    },
                    {
                        "data": "unit_kerja"
                    },
                    {
                        "data": "tgl_pengajuan"
                    },
                    {
                        "data": "tgl_pelaksanaan_awal"
                    },
                    {
                        "data": "tgl_pelaksanaan_akhir"
                    },
                    {
                        "data": "durasi"
                    },
                    {
                        "data": "jenis_training"
                    },
                    {
                        "data": "jenis_training"
                    },
                    {
                        "data": "realisasi_biaya_decision",
                        "data": "status_non_memo",
                        render: function(data, type, row, meta) {
                            return (row.realisasi_biaya_decision == '' && row.status_non_memo == '1' || row.realisasi_biaya_decision === null && row.status_non_memo == '1') ? 'Proses Pengajuan' : row.realisasi_biaya_decision;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return '<button class="btn btn-primary" value="' + data.nomor_pengajuan + '" onclick="views()" >View</button></a>';
                        }
                    }
                ],
                "oLanguage": {
                    sProcessing: "<img src='<?= base_url() ?>Assets/images/loading_mega.gif' width='100px'>"
                },
            });
        }

        // tampilan realisasi table
        function realisasi_table() {
            var table = $('#table_realisasi').DataTable({
                language: {
                    searchPlaceholder: "No. MD"
                },
                "destroy": true,
                "searching": true,
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": false, // Set true agar bisa di sorting
                "order": [
                    [0, 'asc']
                ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax": {
                    "url": "<?= base_url('Program_Training/Proses_pengajuan_training_c/view_data_query/'); ?>", // URL file untuk proses select datanya
                    "type": "POST",
                    "data": {
                        'status_non': statusData
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ], // Combobox Limit
                "columns": [{
                        "data": 'nomor_pengajuan',
                        "sortable": false, // !!! id_sort
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "nomor_pengajuan"
                    },
                    {
                        "data": "perihal"
                    },
                    {
                        "data": "unit_kerja"
                    },
                    {
                        "data": "tgl_pengajuan"
                    },
                    {
                        "data": "tgl_pelaksanaan_awal"
                    },
                    {
                        "data": "tgl_pelaksanaan_akhir"
                    },
                    {
                        "data": "durasi"
                    },
                    {
                        "data": "durasi"
                    },
                    {
                        "data": "durasi"
                    },
                    {
                        "data": "durasi"
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return '<button class="btn btn-primary" value="' + data.nomor_pengajuan + '" onclick="views()" >View</button></a>';
                        }
                    }
                ],
                "oLanguage": {
                    sProcessing: "<img src='<?= base_url() ?>Assets/images/loading_mega.gif' width='100px'>"
                },
            });
        }

        $("#cari").on('click', function() {
            statusData = $('select[name=status_data] option').filter(':selected').val();
            if (statusData == 1) {
                $('.content_pengajuan').show();
                $(".content_realisasi").hide()
                default_dt(statusData);
            } else if (statusData == 2) {
                $('.content_pengajuan').hide();
                $(".content_realisasi").show()
                realisasi_table(statusData)
            } else {
                $('.content_pengajuan').show();
                $(".content_realisasi").hide()
                default_dt(statusData);
            }
        });
    });




    function views() {
        var val = {};
        // val.modal = 'modal';
        val.no_md = event.target.value;
        window.location.assign('<?php echo base_url() ?>Program_training/Proses_pengajuan_training_c/detail_ppt/?no_md=' + val.no_md + '');

    }

    // $('input[type=search]')
</script>