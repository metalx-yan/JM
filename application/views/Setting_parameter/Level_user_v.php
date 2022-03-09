<section class="level_user">
    <div class="row">
        <div class="col-md-12">
            <div class="card ms-5 me-5">
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
                <table class="table table-bordered table-striped align-middle">
                    <tbody>
                        <tr class="text-center">
                            <th scope="row">No</th>
                            <th>Level User</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $no = 1;
                        foreach ($level_user as $row) {
                        ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $row['level_user']; ?></td>
                                <td>
                                    <?php $btn = '<button class="btn btn-success" onclick="edit_modal()" value="' . $row['id'] . '">Edit</button>' ?>
                                    <?= ($access_crud['access_edit'] == '') ? '' : $btn; ?>

                                    <?= ($row['id'] == 2) ? '' : '<button class="btn btn-danger" onclick="delete_modal()" value="' . $row['id'] . '">Delete</button>'; ?>

                                </td>
                            </tr>
                        <?php }
                        ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal_edit"></div>
    <div class="modal_add"></div>
    <div class="modal_delete"></div>
</section>

<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    function close_modal(data_) {
        action = $(data_).attr('data');
        $("#" + action).remove();
    }

    $("#add").on('click', () => {
        var val = {};
        val.modal = 'MODAL ADD LEVEL USER';
        val.id = 'modal_add';
        $.ajax({
            url: '<?= base_url('Setting_parameter/level_user_c/modal_add/') ?>',
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
        val.level_user = event.target.value;
        // alert(val.level_user)

        $.ajax({
            url: '<?= base_url('Setting_parameter/level_user_c/modal/') ?>',
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
        val.modal = 'MODAL DELETE LEVEL USER';
        val.id = 'modal_delete';
        val.level_user = event.target.value;
        $.ajax({
            url: '<?= base_url('Setting_parameter/level_user_c/modal_add/') ?>',
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

    function save() {
        form = $("#task").serialize();
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/Level_user_c/update_level_user/') ?>',
                    type: "post",
                    data: form,
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    complete: function() {
                        $("#loader").hide();
                    },
                    success: function(res) {
                        if (res == 'Berhasil di Simpan') {
                            $('#modal_edit').modal('hide');
                            Swal.fire({
                                title: 'Your has been saved.',
                                icon: 'success',
                            });

                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        } else {
                            alert(res)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('gagal');
                    }
                });
            }
        })
    }

    function add_level_user(data_) {
        action = $(data_).attr('data');
        $('#error').html(" ");
        form = $('#form_' + action).serialize();

        if (action == 'modal_delete') {
            delete_(form);
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Setting_parameter/Level_user_c/validate/'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    if (data.action == 'ok') {
                        add_(form);
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

    function add_(form) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Save',
            denyButtonText: `Cancel`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/Level_user_c/save_/') ?>',
                    type: "post",
                    data: form,
                    success: function(res) {
                        if (res == 'Berhasil di Simpan') {
                            Swal.fire({
                                title: 'Your has been saved.',
                                icon: 'success',
                                timer: 2000
                            });
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
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
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Setting_parameter/Level_user_c/delete_/') ?>',
                    type: "post",
                    data: form,
                    success: function(res) {
                        if (res == 'Berhasil di Hapus') {
                            Swal.fire({
                                title: 'Your file has been deleted.',
                                icon: 'success',
                                timer: 2000
                            });
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
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
        names = $(tes).attr('name');
        term = $("input[type=text][name=" + names + "]").val();
        val = {};
        val[names] = term;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Setting_parameter/Level_user_c/validate_keyup/'); ?>",
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