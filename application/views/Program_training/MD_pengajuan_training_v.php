
<section class="content" style="margin:-40px 0 0 0 ;">
    <div class="row title-content bg-warning m-3 p-2">
        <div class="col-12">
            <h5>List Data Pengajuan Training</h5>
        </div>
    </div>
    <div class="table-content m-3">
        <table id="example" class="table display table-bordered align-middle">
            <thead class="text-center tb-md">
                <tr>
                    <!-- <th scope="row">No</th> -->
                    <th>No. MD</th>
                    <th>Perihal</th>
                    <th>Dari</th>
                    <th>Tgl MD</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Durasi</th>
                    <th>Kelompok Training</th>
                    <th>Jenis Training</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</section>

<div class="modals">

</div>

<script>
    $(document).ready(function() {
        default_dt();
        $('#loader').hide();

        function default_dt() {
            $('#example').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": false, // Set true agar bisa di sorting
                "order": [
                    [0, 'asc']
                ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax": {
                    "url": "<?= base_url('Program_Training/MD_pengajuan_training_c/view_data_query/'); ?>", // URL file untuk proses select datanya
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ], // Combobox Limit
                "columns": [{
                        "data": "nomor_pengajuan"
                    },
                    {
                        "data": "perihal"
                    },
                    {
                        "data": "nip_pengaju"
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
                        "data": "training"
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return '<button class="btn btn-primary" value="' + data.nomor_pengajuan + '" onclick="views()" >View</button>';
                        }
                    }
                ],
                
                "oLanguage": {sProcessing: "<img src='<?= base_url() ?>Assets/images/loading_mega.gif' width='100px'>"},
            });
        }
    });

    function views() {
        var val = {};
        val.modal = 'modal';
        val.no_md = event.target.value;
        $.ajax({
            url: '<?php echo base_url() ?>Program_Training/MD_pengajuan_training_c/view_data_query/',
            type: 'POST',
            data: val,
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(data) {
                if (JSON.parse(data).status == true) {
                    $('.modals').html(JSON.parse(data).modal);
                    $('#Detail_ListMD').modal('show');
                } else {
                    alert(JSON.parse(data).msg);
                }
            }
        })
    }

    function simpan_staff() {
        var val = {};
        val.action = 'save';
        val.no_md = $('#no_md').val();
        val.staff_hcmg = $('#staff_hcmg').val();

        if (val.staff_hcmg == 0) {
            Swal.fire({
                icon: 'warning',
                // title: 'Oops...',
                text: 'STAFF HCMG HARAP DIISI'
            })
        } else {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: val.staff_hcmg + " untuk " + val.no_md,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?php echo base_url() ?>Program_Training/MD_pengajuan_training_c/view_data_query/', val, function(data) {
                        if (data.status == false) {
                            swalWithBootstrapButtons.fire(
                                data.msg,
                                'error'
                            )
                        } else {
                            swalWithBootstrapButtons.fire(
                                data.msg,
                                'Staff HCMG Berhasil di simpan',
                                'success'
                            );

                            $('#Detail_ListMD').modal('hide');
                            window.location.reload();
                        }
                    });


                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '',
                        'Cancelled',
                        'error'
                    )
                }
            })


        }

    }
</script>