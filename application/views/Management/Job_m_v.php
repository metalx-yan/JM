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
                <?php if ($jabatan == '100') {
                    # code...
                 ?>
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
                  <?php } else if($jabatan == '101') {?>
                    <div class="card">
                    <div class="card-header">
                      Search
                    </div>
                    <form id="form_search">

                      <div class="card-body">
                            <div class="mb-3 row">
                              <label class="col-sm-5 col-form-label">Position</label>
                              <div class="col-sm-7 form-group">
                              <select onchange="check_v(this)" name="posisi" id="input-posisi" class="form-select form-select-sm" data-live-search="true" aria-label=".form-select-sm example" required>
                                <option value="" selected></option>
                                <?php foreach($position as $p):?>
                                    <option value="<?= $p['position_name']?>"><?= $p['position_name']; ?></option>
                                <?php endforeach; ?>
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
                      <table id="manage_menu_sec" class="table table-bordered table-striped text-center align-middle" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Posisi</th>
                                <th>Nama Posisi</th>
                                <th>Nama Job</th>
                                <th>Status</th>
                                <th>Job</th>
                            </tr>
                        </thead>
                      </table>
                    </div>
                    
                  </div>
                  <?php } else if($jabatan == '102') {?>
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

                            <div class="mb-3 row">
                              <label class="col-sm-5 col-form-label">Status</label>
                              <div class="col-sm-7 form-group">
                              <select onchange="check_v(this)" name="status" id="input-status" class="form-select form-select-sm status" aria-label=".form-select-sm example">
                                <option value="" selected></option>
                                <option value="1">Sudah Selesai</option>
                                <option value="0">Dalam Proses</option>
                              </select>
                              <span id="error"></span>
                              </div>
                            </div>

                              <!-- <button type="button" data="search" onclick="subsearch(this)" class="btn btn-warning float-end">Search</button> -->
                      </div>
                      </form>
                  </div>
                  <br>
                  <div class="card">
                    <div class="card-header">
                      List Job
                    </div>
                    <div class="card-body">
                      <table id="manage_menu_third" class="table table-bordered table-striped text-center align-middle" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Posisi</th>
                                <th>Nama Posisi</th>
                                <th>Nama Job</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                      </table>
                    </div>
                    
                  </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="modal_add"></div>
    <div class="modal_edit"></div>
    <div class="modal_view"></div>
    <div class="modal_send_admin"></div>
    <div class="modal_delegate"></div>
    <div class="modal_mapping"></div>
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
    if (form.direktorat == undefined && form.organisasi == undefined) {
        console.log(form)
        var datatable = $('#manage_menu_sec').DataTable({
            "destroy": true,
            "processing": false,
            "responsive": true,
            "serverSide": true,
            "ordering": true,  
            "ajax": {
                "url": "<?= base_url('Management/Job_m_c/get_sec/'); ?>", 
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
            ],  
                "columns": [
                    {
                        "data": 'id',
                        "sortable": false,  
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
                        "data": "job_title"
                    },
                    
                    {
                        "data": "status"
                    },
                    {
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            if (data.status == 'Admin') {
                                if (data.status_awal == '1' && data.status_akhir == '1') {
                                    mappings = '<button class="btn btn-secondary m-3" value="'+data.id+'" onclick="mapping_modal()">Mapping</button>'
                                } else {
                                    mappings = ''
                                }
                                adds = '<button class="btn btn-primary m-3" value="'+data.id+'" onclick="view_modal()">View</button>'
                                views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="send_admin_modal()">Edit</button>'
                                return mappings + adds + views
                                
                            } else {
                                adds = '<button class="btn btn-primary m-3" disabled >View</button>'
                                views = '<button id="btn-views"  class="btn btn-warning m-3" disabled >Edit</button>'
                                return adds + views
                            }
                        },

                    }
                    
                ],
        });
    } else {
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
                        adds = '<button class="btn btn-primary m-3" value="'+data.id+'" onclick="view_modal()">View</button>'
                        views = '<button id="btn-edits" value="'+data.id+'" class="btn btn-warning m-3" onclick="edit_modal()">Edit</button>'
                        print = '<button id="btn-prints" value="'+data.id+'" class="btn btn-secondary m-3" onclick="print_data()">Print</button>'
                        return adds + views + print
                    },

                }
            ],
    });
    }
}

// function view() {
//     var val = {};
//     val.modal = 'MODAL VIEW JOB';
//     val.id = 'modal_edit';
//     val.form_id = "form_" + val.id;
//     val.job = event.target.value;
//     val.tujuan = 'tujuan';
//     val.tugas = 'tugas';
//     val.kewenangan = 'kewenangan';
//     val.kompetensi = 'kompetensi';
//     val.kualifikasi = 'kualifikasi';
//     $.ajax({
//         url: '<?= base_url('Management/Job_m_c/view/') ?>',
//         type: "get",
//         data: val,
//         success: function(res) {
//             window.location.assign('<?php echo base_url() ?>Management/Job_m_c/view/?job=' + val.job + '');
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             alert('gagal');
//         }
//     });
// };
function render() {
    name = $("#input-mapping").val();
    job = $("#job_title").val();
    position = $("#position_name").val();
    arr = name.split("-");
    $('#nama_value').html(arr[0]);
    $('#position_value').html(job);
    $('#job_value').html(position);

    if (arr[0] == '') {
        
        $('.btn-mapping').prop('disabled', true)
    } else {
        $('.btn-mapping').prop('disabled', false)

    }
    // console.log(myArray)
    // $("preview").innerHTML = html;
}

function view_modal() {
    var val = {};
    val.modal = 'MODAL VIEW JOB';
    val.id = 'modal_view';
    val.form_id = "form_" + val.id;
    val.job = event.target.value;
    console.log(val);
    val.tujuan = 'tujuan';
    val.tugas = 'tugas';
    val.kewenangan = 'kewenangan';
    val.kompetensi = 'kompetensi';
    val.kualifikasi = 'kualifikasi';
    $.ajax({
        url: '<?= base_url('Management/Job_m_c/view_job/') ?>',
        type: "POST",
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

function mapping_modal() {
    var val = {};
    val.modal = 'MODAL MAPPING JOB';
    val.id = 'modal_mapping';
    val.form_id = "form_" + val.id;
    val.job = event.target.value;
    $.ajax({
        url: '<?= base_url('Management/Job_m_c/mapping_job/') ?>',
        type: "POST",
        data: val,
        success: function(res) {
            $(".modal_mapping").html(res);
            $('#modal_mapping').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_mapping').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
};

function print_data(){
    data = event.target.value
    console.log(data);
    var val = {};
    val.job_list_id = data
    $.ajax({
        url: '<?= base_url('Management/Job_m_c/print/') ?>',
        type: "GET",
        data: val,
        success: function(res) {
            enc = btoa(val.job_list_id+ ' _')
            window.open('<?php echo base_url() ?>Management/Job_m_c/print/?string='+ enc);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
}

function send(form){
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/send_admin/') ?>',
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
                        $('#modal_send_admin').modal('hide');
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

function send_admin_modal() {
    var val = {};
    val.modal = 'MODAL EDIT JOB';
    val.id = 'modal_send_admin';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    // console.log(val.position)
    val.tujuan = 'tujuan';
    val.tugas = 'tugas';
    val.kewenangan = 'kewenangan';
    val.kompetensi = 'kompetensi';
    val.kualifikasi = 'kualifikasi';
    val.kpi = 'kpi';
    $.ajax({
        url: '<?= base_url('/Management/Job_m_c/send_admin_modal/') ?>',
        type: "post",
        data: val,
        success: function(res) {

            $(".modal_send_admin").html(res);
            $('#modal_send_admin').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_send_admin').modal('show');
            
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

function delegate_modal(data_) {
    $('#modal_send_admin').modal('hide');
    action = $(data_).attr('data');
    
    var val = {};
    val.modal = 'MODAL DELEGATE JOB';
    val.id = 'modal_delegate';
    val.form_id = "form_" + val.id;
    val.position = action;
    val.tujuan = 'tujuan';
    val.tugas = 'tugas';
    val.kewenangan = 'kewenangan';
    val.kompetensi = 'kompetensi';
    val.kualifikasi = 'kualifikasi';
    val.kpi = 'kpi';
    $.ajax({
        url: '<?= base_url('/Management/Job_m_c/delegate_modal/') ?>',
        type: "post",
        data: val,
        success: function(res) {

            $(".modal_delegate").html(res);
            $('#modal_delegate').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_delegate').modal('show');
            
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
        if (action == 'kualifikasi'  || action == 'tugas' || action == 'modal_send_admin' || action == 'mapping') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Management/Job_m_c/validate_kual'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    if (data.action == 'ok') {
                        if (action == 'modal_send_admin') {
                            send(form)
                        } else if (action == 'mapping') {
                            mapping(form)
                        } else {
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
            
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Management/Job_m_c/validate'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    if (data.action == 'ok') {
                       if (action == 'tujuan') {
                            save(form);
                        } else if (action == 'kewenangan' || action == 'kompetensi' || action == 'kpi' || action == 'kualifikasi') {
                            save_multiple(form);
                        }  else if(action == 'modal_delegate') {
                            delegate(form)
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
        var value_status =  $('#input-status').val() == '' ? undefined : $('#input-status').val();

        var val = {};
        val.direktorat = value;
        val.status = value_status;
        autosearch(val);
        $.post('<?php echo base_url()?>Management/Job_m_c/change_direktorat',val,function(data){ 
        // console.log(data);
            $('.organisasi').html(data);
        });
    });

    $('#input-organisasi').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var value_dir = $('#input-direktorat').val() == '' ? undefined : $('#input-direktorat').val();
        var val = {};
        val.organisasi = value;
        val.direktorat = value_dir;
        autosearch(val);
        $.post('<?php echo base_url()?>Management/Job_m_c/change_organisasi',val,function(data){ 
        // console.log(data);
            $('.posisi').html(data);
        });
    });

    $('#input-posisi').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var value_dir = $('#input-direktorat').val() == '' ? undefined : $('#input-direktorat').val();
        var value_org = $('#input-organisasi').val() == '' ? undefined : $('#input-organisasi').val();
        var value_status =  $('#input-status').val()  == '' ? undefined : $('#input-status').val();
        var val = {};
        val.direktorat = value_dir;
        val.organisasi = value_org;
        val.posisi = value;
        val.status = value_status;


        autosearch(val);
       
    });

    $('#input-status').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var value_dir = $('#input-direktorat').val() == '' ? undefined : $('#input-direktorat').val();
        var value_org = $('#input-organisasi').val() == '' ? undefined : $('#input-organisasi').val();
        var value_status =  $('#input-status').val()  == '' ? undefined : $('#input-status').val();
        var value_posisi =  $('#input-posisi').val() == '' ? undefined : $('#input-posisi').val();
        var val = {};
        val.direktorat = value_dir;
        val.organisasi = value_org;
        val.status = value_status;
        val.posisi = value_posisi;

        autosearch(val);
       
    });

    function autosearch(value) 
    {
        var vals = {};
        var value_status =  $('#input-status').val()  == '' ? undefined : $('#input-status').val();
        val.direktorat = value.direktorat;
        val.organisasi = value.organisasi;
        val.posisi = value.posisi;
        val.status = value.status;
        console.log(val)
        search_option(val)
    }

    function search_option(form){
        var datatable = $('#manage_menu_third').DataTable({
        "destroy": true,
        "processing": false,
        "responsive": true,
        "serverSide": true,
        "ordering": true, // Set true agar bisa di sorting
        "ajax": {
            "url": "<?= base_url('Management/Job_m_c/get_live/'); ?>", // URL file untuk proses select datanya
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
                    "data": "position_name"
                },
                {
                    "data": "job_title"
                },
                {
                    data: null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        if (data.status_awal == data.status_akhir) {
                            success = '<i class="bi bi-check2-circle" style="color:green;"></i>'
                        } else {
                            success = '<i class="bi bi-arrow-clockwise"></i>'
                        }
                        return success 
                    },

                },
                {
                    data: null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        if (data.status_awal == data.status_akhir) {
                            success = 'Sudah Selesai'
                        } else {
                            success = 'Dalam Proses'
                        }
                        return success 
                    },

                }
            ],
    });
    }

});

function check_dropdown(data_) {
    action = $(data_).attr('id');
    action_data = $(data_).attr('data');
    // console.log(action_data)
    var value = $('#'+action +' option:selected').text();
    var val = {};
    val.tingkat_pendidikan = value;
    $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
        $('.jurusan'+action_data).html(data);
        // console.log(data)
    });

}

function close_modal(data_) {
    action = $(data_).attr('data');
    if (action == 'delegate') {
        $('#modal_send_admin').modal('show');
    } else {
        $("#" + action).remove();
    }
}

function mapping(form) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/mapping_/') ?>',
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

function delegate(form) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/delegate_/') ?>',
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
    val.modal = 'MODAL EDIT JOB';
    val.id = 'modal_edit';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    // console.log(val.position)
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

function navtab(data_){
    action = $(data_).attr('data');
    var data_navtab = $('div#inputFormRow_'+action).length;
    console.log(data_navtab)
    if (data_navtab > 0) {
        $('.btn_save_'+action).attr('disabled', false);
    } else {
        $('.btn_save_'+action).attr('disabled', true);
    }
    // console.log(data_navtab);
}

function tabs(data_) {
    action = $(data_).attr('data');
    var arr = []
    arr.push($('div#inputFormRow_'+action))
    var test = '';
    if (arr[0].length >= 0 ) {
        $('.btn_save_'+action).attr('disabled', false);
        test = arr[0].length+1;
    } else {
        test = arr[0].length;
    }
    // add row
    var html = '';
    if (action == 'kualifikasi') {
        html = '<div id="inputFormRow_'+ action +'"><div class="row"><div class="col-md-3"> <label for="">Tingkat Pendidikan</label><select name="tingkat_pendidikan[]" id="input-tingkat_pendidikan'+test+'" class="form-select form-select-sm" aria-label=".form-select-sm example"><?php foreach($tingkat_pendidikan as $tingkat):?><option value="<?= $tingkat['id']?>"><?= $tingkat['edu_name']; ?></option><?php endforeach; ?></select><span id="error"></span></div><div class="col-md-3"> <label for="">Jurusan</label><select name="jurusan[]" id="input-jurusan" class="form-select form-select-sm jurusan'+test+'" aria-label=".form-select-sm example"> </select> <span id="error"></span></div> <div class="col-md-3"><label for="">Persyaratan Khusus</label><input type="text" id="input-syarat"  value="<?php echo (('a') ? '' : '') ?>" name="syarat[]" class="form-control form-control-sm" required> <span id="error"></span></div><div class="col-md-3 d-flex align-content-end flex-wrap"><button id="removeRow_'+ action +'" data="'+ action +'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div></div>';
        
    } else {
        var html = '<div id="inputFormRow_'+ action+ '"><div class="input-group mb-3"><input type="text" name="field_'+action+'[]" class="form-control form-control-sm m-input enter_'+action +'" placeholder="" autocomplete="off"><div class="input-group-append"><button id="removeRow_' +action+ '"  data="'+action+'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div>';
    }

    $('#newRow_'+action).append(html);

    $('#input-tingkat_pendidikan'+test).change(function(){ 
        var value = $(this).val();
        var value = $('#input-tingkat_pendidikan'+test+' option:selected').text();
        var val = {};
        val.tingkat_pendidikan = value;
        console.log(value)
        $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
        console.log(data);
            $('.jurusan'+test).html(data);
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



