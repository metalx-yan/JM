<section class="body-content">
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
                <div class="card">
                    <div class="card-header">
                      Search
                    </div>
                    <form id="form_search">

                      <div class="card-body">
                            <div class="mb-3 row">
                              <label class="col-sm-5 col-form-label">Direktorat</label>
                              <div class="col-sm-7 form-group">
                              <select onchange="check_v(this)" name="direktorat" id="input-direktorat" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option value="" selected></option>
                                <?php foreach($direktorat as $direktorat):?>
                                    <option value="<?= $direktorat['id_dir']?>"><?= $direktorat['dir_group_name']; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <span id="error"></span>
                              </div>
                            </div>

                            <div class="mb-3 row">
                              <label class="col-sm-5 col-form-label">Organisasi</label>
                              <div class="col-sm-7 form-group">
                              <select onchange="check_v(this)" name="organisasi" id="input-organisasi" class="form-select form-select-sm organisasi" aria-label=".form-select-sm example">
                                <option value="" selected></option>
                              </select>
                              <span id="error"></span>
                              </div>
                            </div>

                            <div class="mb-3 row">
                              <label class="col-sm-5 col-form-label">Posisi</label>
                              <div class="col-sm-7 form-group">
                              <select onchange="check_v(this)" name="posisi" id="input-posisi" class="form-select form-select-sm posisi" aria-label=".form-select-sm example">
                                <option value="" selected></option>
                              </select>
                              <span id="error"></span>
                              </div>
                            </div>

                              <button type="button" data="search" onclick="subsearch(this)" class="btn btn-warning float-end">Search</button>
                              <br>
                      </div>
                      </form>
                  </div>
                  <br>
                  <div class="card">
                    <div class="card-header">
                      List Position
                    </div>
                    <div class="card-body">
                      <table id="manage_menu" class="table table-bordered table-striped text-center align-middle" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Posisi</th>
                                <th>Nama Posisi</th>
                                <th>Job</th>
                            </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <div class="modal_add"></div>
    <div class="modal_view"></div>

</section>

<script>


function subsearch(data_) {
  val = {};
  val.direktorat = $('#input-direktorat').val()
  val.organisasi = $('#input-organisasi').val()
  val.posisi = $('#input-posisi').val()
  search(val);
}

function search(form) {
    console.log(form);
  var datatable = $('#manage_menu').DataTable({
    "destroy": true,
    "processing": false,
    "responsive": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "ajax": {
        "url": "<?= base_url('Management/Position_c/get/'); ?>", // URL file untuk proses select datanya
        "type": "POST",
        "data": form,
        beforeSend: function() {
            $("#loader").show();
        },
        complete: function() {
            $("#loader").hide();
        },
    },
    "deferRender": true,
    "aLengthMenu": [
        [5, 10, 50],
        [5, 10, 50]
    ], // Combobox Limit
        "columns": [
            {
                "data": 'position_id',
                "sortable": false, // !!! id_sort
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "position_id"
            },
            {
                "data": "position_name"
            },
            {
                data: null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    adds = '<button class="btn btn-primary" value="'+data.position_id+'" onclick="add_modal()" id="add">Add</button>'
                    views = '<button id="btn-views"  value="'+data.position_id+'" class="btn btn-warning m-3" onclick="view_modal()">View</button>'
                    return adds + views
                },

            }
        ],
  });
}

function action_submit(data_) {
    action = $(data_).attr('data');
    console.log(action)
    $('#error').html(" ");
    form = $("#form_" + action).serialize();
    if (action == 'modal_delete') {
        delete_(form);
    } else {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Management/Position_c/validate'); ?>",
            data: form,
            dataType: "json",
            success: function(data) {
                
                if (data.action == 'ok') {
                    if (action == 'modal_edit') {
                        edit(form);
                    } else if (action == 'modal_add') {
                        save(form);
                    } else {
                        delete_(form);
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

function add_modal() {
    var val = {};
    val.modal = 'MODAL ADD LIST JOBS';
    val.id = 'modal_add';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    console.log(val);
    $.ajax({
        url: '<?= base_url('Management/Position_c/modal/') ?>',
        type: "post",
        data: val,
        success: function(res) {
            $(".modal_add").html(res);
            $('#modal_add').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_add').modal('show');
            $('#input-job_function').change(function(){ 
                // alert('tes');
                var value = $(this).val();
                var val = {};
                val.job_function = value;
                console.log(val);
                $.post('<?php echo base_url()?>Management/Position_c/change_job_function',val,function(data){ 
                    $('.job_sub_function').html(data);
                });
            });
            $('#input-job_family').change(function(){ 
                // alert('tes');
                var value = $(this).val();
                var val = {};
                val.job_family = value;
                console.log(val);
                $.post('<?php echo base_url()?>Management/Position_c/change_job_family',val,function(data){ 
                    $('.job_sub_family').html(data);
                });
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
};

function save(form) {
    console.log(form);
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Position_c/save_/') ?>',
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

function view_modal() {
    var val = {};
    val.modal = 'MODAL VIEW JOB';
    val.id = 'modal_view';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    console.log(val);
    $.ajax({
        url: '<?= base_url('Management/Position_c/modal_view/') ?>',
        type: "post",
        data: val,
        success: function(res) {
            $(".modal_view").html(res);
            $('#modal_view').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_view').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
};

$('#input-direktorat').change(function(){ 
    // alert('tes');
    var value = $(this).val();
    var val = {};
    val.direktorat = value;
    $.post('<?php echo base_url()?>Management/Position_c/change_direktorat',val,function(data){ 
    console.log(data);
        $('.organisasi').html(data);
    });
});

$('#input-organisasi').change(function(){ 
    // alert('tes');
    var value = $(this).val();
    var val = {};
    val.organisasi = value;
    $.post('<?php echo base_url()?>Management/Position_c/change_organisasi',val,function(data){ 
    console.log(data);
        $('.posisi').html(data);
    });
});

function check_v(sel) {
        names = $(sel).attr('name');
        val = {};
        val[names] = sel.value;
        // console.log(val);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Management/Position_c/validate_keyup/'); ?>",
            data: val,
            dataType: "json",
            success: function(data) {
                // console.log(data);
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

    function key(tes) {
        console.log(key);
        names = $(tes).attr('name');
        term = $("input[type=text][name=" + names + "]").val();
        val = {};
        val[names] = term;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Management/Position_c/validate_keyup/'); ?>",
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



