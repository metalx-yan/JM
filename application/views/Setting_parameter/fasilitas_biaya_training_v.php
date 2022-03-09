<section class="fasilitas_biaya_training">
    <div class="row w-100">
        <div class="col-md-12">
            <div class=" ms-5 me-5">

                <div class="card-header bg-warning mb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6><?= $title_head ?></h6>
                        </div>
                        <div class="col-6 text-end">
                            <?= $access_crud['access_add'] ?>
                        </div>
                    </div>
                </div>

                <table id="manage_menu" class="table table-bordered table-striped text-center align-middle" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">No</th>
                            <th>Kode Lokasi</th>
                            <th>Kode Cabang Peserta</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</section>

<div class="modal_add">

</div>

<div class="modal_edit">

</div>
<div class="modal_delete">

</div>
<script>
    $(document).ready(function() {
        default_dt();
        // access();

        function default_dt() {
            $('#manage_menu').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                "order": [
                    [0, 'asc']
                ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax": {
                    "url": "<?= base_url('Setting_parameter/fasilitas_biaya_training_c/get/'); ?>", // URL file untuk proses select datanya
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ], // Combobox Limit
                "columns": [{
                        "data": 'kode_fasilitas',
                        "sortable": false, // !!! id_sort
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "nama_tempat"
                    },
                    {
                        "data": "kode_cabang"
                    },
                    {
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            edits = ('<?= $access_crud['access_edit']['visible'] ?>' == '') ? '' : '<?= $access_crud['access_edit']['btn'] ?>'
                            deletes = ('<?= $access_crud['access_delete']['visible'] ?>' == '') ? '' : '<?= $access_crud['access_delete']['btn'] ?>'
                            return edits + deletes
                        },
                        "visible": ('<?= $access_crud['access_edit']['visible'] ?>' == '' && '<?= $access_crud['access_delete']['visible'] ?>' == '')? false:true
                    }
                ],
            });
            
        }

        

    });

    function close_modal(data_) {
        action = $(data_).attr('data');
        $("#" + action).remove();
    }


    $("#add").on('click', () => {
        var val = {};
        val.modal = 'MODAL ADD FASILITAS BIAYA TRAINING';
        val.id = 'modal_add';

        $.ajax({
            url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/modal') ?>',
            type: "post",
            data: val,
            success: function(res) {
                $(".modal_add").html(res);
                $('#modal_add').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modal_add').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    });

    function edit_modal() {
        var val = {};
        val.modal = 'MODAL EDIT FASILITAS BIAYA TRAINING';
        val.id = 'modal_edit';
        val.kode_fasilitas = event.target.value;
        
        console.log(val);
        $.ajax({
            url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/modal/') ?>',
            type: "post",
            data: val,
            success: function(res) {
                // alert(res);
                $(".modal_edit").html(res);
                $('#modal_edit').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modal_edit').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    };

    function delete_modal() {
        var val = {};
        val.modal = 'MODAL DELETE FASILITAS BIAYA TRAINING';
        val.id = 'modal_delete';
        val.kode_fasilitas = event.target.value;
        

        $.ajax({
            url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/modal/') ?>',
            type: "post",
            data: val,
            success: function(res) {
                $(".modal_delete").html(res);
                $('#modal_delete').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modal_delete').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    };

    function action_submit(data_) {
        action = $(data_).attr('data');
        $('#error').html(" ");
        form = $("#form_"+action).serialize();      

        if (action == 'modal_delete') {
            delete_(form);
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Setting_parameter/fasilitas_biaya_training_c/validate'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    if (data.action == 'ok') {
                        if (action == 'modal_edit') {
                            edit(form);
                        } else if (action == 'modal_add') {
                            save(form);
                        }
                    } else {
                        $.each(data, function(key, value) {
                            if (value == '') {
                                $('#input-' + key).removeClass('is-invalid');
                                $('#input-' + key).addClass('is-valid');
                                $('#input-' + key).parents('.form-group').find('#error').html(value);
                            } else {
                                $('#input-' + key).addClass('is-invalid');
                                $('#input-' + key).parents('.form-group').find('#error').html(value);
                            }
                        });
                    }

                }
            });
        }

    }

    function edit(form) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Cancel`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/edit_/') ?>',
                    type: "post",
                    data: form,
                    success: function(res) {
                        if (res == 'Berhasil Update') {
                            Swal.fire({
                                title: 'Your has been updated.',
                                icon: 'success',
                                timer: 2000
                            });
                            setTimeout(function(){ location.reload(true); }, 1000);
                        } else {
                            alert(res);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('gagal');
                    }
                });

            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    }

    function save(form) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Cancel`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/save_/') ?>',
                    type: "post",
                    data: form,
                    success: function(res) {
                        if (res == 'Berhasil di Simpan') {
                            setTimeout(function(){ location.reload(true); }, 1000);
                            Swal.fire({
                                title: 'Your has been saved.',
                                icon: 'success',
                                timer: 2000
                            });
                        } else {
                            alert(res);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('gagal');
                    }
                });

            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    }

    function delete_(form) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            denyButtonText: `Cancel`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/fasilitas_biaya_training_c/delete_/') ?>',
                    type: "post",
                    data: form,
                    success: function(res) {
                        if (res == 'Berhasil di Hapus') {
                            Swal.fire({
                                title: 'Your file has been deleted.',
                                icon: 'success',
                                timer: 2000
                            });
                            setTimeout(function(){ location.reload(true); }, 1000);
                        } else {
                            alert(res);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('gagal');
                    }
                });
            }
            // else{
            //     alert('gagal');
            // }
        })

    }


    function key(tes) {
        $('.digitRupiah').mask('#,##0', {
            reverse: true
        });
        names = $(tes).attr('name');
        term = $("input[type=text][name=" + names + "]").val();
        val = {};
        val[names] = term;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Setting_parameter/fasilitas_biaya_training_c/validate_keyup/'); ?>",
            data: val,
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    if (value == '') {
                        $('#input-' + key).removeClass('is-invalid');
                        $('#input-' + key).addClass('is-valid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    } else {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    }

                });
            }
        });
    }

    function check_v(sel) {
        names = $(sel).attr('name');
        val = {};
        val[names] = sel.value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Setting_parameter/fasilitas_biaya_training_c/validate_keyup/'); ?>",
            data: val,
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    if (value == '') {
                        $('#input-' + key).removeClass('is-invalid');
                        $('#input-' + key).addClass('is-valid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    } else {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    }

                });
            }
        });
    }
</script>