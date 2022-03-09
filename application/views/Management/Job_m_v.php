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
                            <!-- <?= $access_crud['access_add'] ?> -->
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
                      List Job
                    </div>
                    <div class="card-body">
                      <table id="manage_menu" class="table table-bordered table-striped text-center align-middle" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Posisi</th>
                                <th>Nama Job</th>
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
    <div class="modal_edit"></div>

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
        "url": "<?= base_url('Management/Job_m_c/get/'); ?>", // URL file untuk proses select datanya
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
                "data": 'id',
                "sortable": false, // !!! id_sort
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "position_id"
            },
            {
                "data": "job_title"
            },
            {
                "data": "position_name"
            },
            {
                data: null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    // adds = '<button class="btn btn-primary" value="'+data.id+'" onclick="add_modal()" id="add">Add</button>'
                    views = '<button id="btn-edits" value="'+data.id+'" class="btn btn-warning m-3" onclick="edit_modal()">Edit</button>'
                    return views
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
    console.log(form);
    if (action == 'modal_delete') {
        delete_();
    } else {
        console.log(action)
        if (action == 'kualifikasi') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Management/Job_m_c/validate_kual'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    if (data.action == 'ok') {
                        save_multiple(form);
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
            
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Management/Job_m_c/validate'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    if (data.action == 'ok') {
                       if (action == 'tujuan') {
                            save(form);
                        } else if (action == 'kewenangan' || action == 'kompetensi' || action == 'kpi' || action == 'kualifikasi') {
                            save_multiple(form);
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
}

$(document).ready(function() {
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#input-direktorat').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var val = {};
        val.direktorat = value;
        $.post('<?php echo base_url()?>Management/Job_m_c/change_direktorat',val,function(data){ 
        console.log(data);
            $('.organisasi').html(data);
        });
    });

    $('#input-organisasi').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var val = {};
        val.organisasi = value;
        $.post('<?php echo base_url()?>Management/Job_m_c/change_organisasi',val,function(data){ 
        console.log(data);
            $('.posisi').html(data);
        });
    });

});

function close_modal(data_) {
    action = $(data_).attr('data');
    $("#" + action).remove();
}


function save(form) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/save_/') ?>',
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
                        // $('#modal_edit').modal('hide');
                        Swal.fire({
                            title: 'Your has been saved.',
                            icon: 'success',
                        });

                        // setTimeout(function() {
                        //     location.reload(true);
                        // }, 1000);
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

function save_multiple(form) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/save_multiple_/') ?>',
                type: "post",
                data: form,
                beforeSend: function() {
                    $("#loader").show();
                },
                complete: function() {
                    $("#loader").hide();
                },
                success: function(res) {
                    console.log(res)
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
                        // console.log(res)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('gagal');
                }
            });
        }
    })
}

function edit_modal() {
    var val = {};
    val.modal = 'MODAL VIEW JOB';
    val.id = 'modal_edit';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    val.tujuan = 'tujuan';
    val.tugas = 'tugas';
    val.kewenangan = 'kewenangan';
    val.kompetensi = 'kompetensi';
    val.kualifikasi = 'kualifikasi';
    val.kpi = 'kpi';
    $.ajax({
        url: '<?= base_url('Management/Job_m_c/modal_edit/') ?>',
        type: "post",
        data: val,
        success: function(res) {

            $(".modal_edit").html(res);
            $('#modal_edit').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_edit').modal('show');
            
            $('#input-tingkat_pendidikan').change(function(){ 
                // alert('tes');
                // var value = $(this).val();
                var value = $('#input-tingkat_pendidikan option:selected').text();
                var val = {};
                val.tingkat_pendidikan = value;
                console.log(value)
                $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
                console.log(data);
                    $('.jurusan').html(data);
                });
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
};

function tabs(data_) {
    action = $(data_).attr('data');
    var arr = []
    arr.push($('div#inputFormRow_'+action))
    if (arr[0].length >= 0 ) {
        $('.btn_save_'+action).attr('disabled', false);
    } 
    console.log(arr[0].length);
    // add row
    
    var html = '';
    if (action == 'kualifikasi') {
        html = '<div id="inputFormRow_'+ action +'"><div class="row"><div class="col-md-3"> <label for="">Tingkat Pendidikan</label><select name="tingkat_pendidikan[]" id="input-tingkat_pendidikan'+arr[0].length+'" class="form-select form-select-sm" aria-label=".form-select-sm example"><?php foreach($tingkat_pendidikan as $tingkat):?><option value="<?= $tingkat['id']?>"><?= $tingkat['edu_name']; ?></option><?php endforeach; ?></select><span id="error"></span></div><div class="col-md-3"> <label for="">Jurusan</label><select name="jurusan[]" id="input-jurusan" class="form-select form-select-sm jurusan_'+arr[0].length+'" aria-label=".form-select-sm example"> </select> <span id="error"></span></div> <div class="col-md-3"><label for="">Persyaratan Khusus</label><input type="text" id="input-syarat"  value="<?php echo (('a') ? '' : '') ?>" name="syarat[]" class="form-control form-control-sm" required> <span id="error"></span></div><div class="col-md-3 d-flex align-content-end flex-wrap"><button id="removeRow_'+ action +'" data="'+ action +'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div></div>';
        
    } else {
        var html = '<div id="inputFormRow_'+ action+ '"><div class="input-group mb-3"><input type="text" name="field_'+action+'[]" class="form-control form-control-sm m-input enter_'+action +'" placeholder="" autocomplete="off"><div class="input-group-append"><button id="removeRow_' +action+ '"  data="'+action+'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div>';
    }

    $('#newRow_'+action).append(html);

    $('#input-tingkat_pendidikan'+arr[0].length).change(function(){ 
        var value = $(this).val();
        var value = $('#input-tingkat_pendidikan'+arr[0].length+' option:selected').text();
        var val = {};
        val.tingkat_pendidikan = value;
        console.log(value)
        $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
        console.log(data);
            $('.jurusan_'+arr[0].length).html(data);
        });
    });
}

function dels(data_){
    action = $(data_).attr('data');

    var arr = []
    arr.push($('div#inputFormRow_'+action))
    if (arr[0].length <= 1) {
        $('.btn_save_'+action).attr('disabled', true);
    } 
    console.log(arr[0].length);

    $(document).on('click', '#removeRow_' +action , function () {
        $(this).closest('#inputFormRow_'+action).remove();
    });
}

function check_v(sel) { 
    names = $(sel).attr('name');
    val = {};
    val[names] = sel.value;
    // console.log(val);
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Management/Job_m_c/validate_keyup/'); ?>",
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
    names = $(tes).attr('name');
    console.log(names);

    term = $("input[type=text][name=" + names + "]").val();
    val = {};
    val[names] = term;

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Management/Job_m_c/validate_keyup/'); ?>",
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

function area(tes) {
    names = $(tes).attr('name');
    ters = $("textarea[name="+ names +"]").val();
    val = {};
    val[names] = ters;
    console.log(val);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Management/Job_m_c/validate_keyup/'); ?>",
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



