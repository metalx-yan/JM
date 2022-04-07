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
                    <form id="form_view">

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
                      List Employee
                    </div>
                    <div class="card-body">
                      <table id="manage_menu" class="table table-bordered table-striped text-center align-middle" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Posisi</th>
                                <th>Unit Kerja</th>
                                <th>Job</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
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
        "url": "<?= base_url('Management/Employee_c/get/'); ?>", // URL file untuk proses select datanya
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
                "data": 'user_name',
                "sortable": false, // !!! id_sort
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "user_name"
            },
            {
                "data": "nama"
            },
            {
                "data": "position_name"
            },
            {
                "data": "singkatan"
            },
            {
                data: null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    adds = '<a href="" onclick="view_modal(this)" style="color:black;" data="'+data.id_job+'">'+data.job_title+'</a>'
                    return adds
                },

            },
            {
                "data": "status_job"
            }
        ],
  });
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
        $.post('<?php echo base_url()?>Management/Employee_c/change_direktorat',val,function(data){ 
        console.log(data);
            $('.organisasi').html(data);
        });
    });

    $('#input-organisasi').change(function(){ 
        // alert('tes');
        var value = $(this).val();
        var val = {};
        val.organisasi = value;
        $.post('<?php echo base_url()?>Management/Employee_c/change_organisasi',val,function(data){ 
        console.log(data);
            $('.posisi').html(data);
        });
    });

});

function close_modal(data_) {
    action = $(data_).attr('data');
    $("#" + action).remove();
}
 
function view_modal(data_) {
    event.preventDefault()
    action = $(data_).attr('data');

    var val = {};
    val.modal = 'MODAL VIEW JOB';
    val.id = 'modal_view';
    val.form_id = "form_" + val.id;
    val.job = action;
    // console.log(action)
    $.ajax({
        url: '<?= base_url('Management/Employee_c/modal_view/') ?>',
        type: "post",
        data: val,
        success: function(res) {
            console.log(res);
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

function check_v(sel) { 
    names = $(sel).attr('name');
    val = {};
    val[names] = sel.value;
    // console.log(val);
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Management/Employee_c/validate_keyup/'); ?>",
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
        url: "<?php echo site_url('Management/Employee_c/validate_keyup/'); ?>",
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



