<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3 row">
          <div class="col-sm-7 form-group">
            <div id="error"></div>
          </div>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header">
                    Job Desc Info
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Kode Job</label>
                        <div class="col-sm-7 form-group">
                            <select onchange="check_v(this)" name="id_job" id="input-id_job" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option value="<?= (( $id_job)? $id_job->id_job : '' )?>" selected><?php echo (( $id_job)? $id_job->id_job : '' ) ?></option>
                            </select>
                        <span id="error"></span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Job</label>
                        <div class="col-sm-7 form-group">
                            <select onchange="check_v(this)" name="job" id="input-job" class="form-select form-select-sm job" aria-label=".form-select-sm example">
                                <option value="<?= (( $id_job)? $id_job->job_title : '' )?>" selected><?php echo (( $id_job)? $id_job->job_title : '' ) ?></option>
                            </select>
                            <span id="error"></span>
                        </div>
                    </div>
                    <div class="">
                        <form id="form_<?= $id ?>">

                            <input type="hidden" value="<?= $position ?>" name="id">

                            <?php if ($status_job_profile == null) {?>
                                <button type="button" data="<?= $position ?>" onclick="delegate_modal(this)" class="btn btn-primary btn-sm float-end" style="margin-left: 10px">Delegate to</button>
                                        <?php if ($status_job_profile == null) {?>
                                                <button type="button" data="modal_send_admin" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end">Send to Admin</button>
                                            <?php  } else {?>

                                            <?php if ($status_job_profile->status != null) {?>
                                                <button type="button" data="modal_send_admin" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end" style="margin-left: 10px">Send to Admin</button>
                                                <button type="button" class="btn btn-success btn-sm float-end" style="cursor:default;">Data Updated to Delegate</button>

                                            <?php } else if($status_job_profile->status == null) { ?>
                                                <button type="button" class="btn btn-warning btn-sm float-end">Waiting Send to Delegate</button>
                                            <?php } else  { ?>
                                            
                                            <?php  }?>
                                        <?php  }?>
                            <?php  } else if ($status_job_profile->status == '1') {?>
                                <button type="button" style="cursor: default;" class="btn btn-success btn-sm float-end">Approved to Admin</button>

                            <?php  } else {?>
                            
                            <?php if ($status_job_profile->status != null && $status_job_profile == null ? : ($status_job_profile->status != NULL && $status_job_profile->status == '0')) {
                                ?>
                                        <button type="button" style="cursor: default;" class="btn btn-success btn-sm float-end">Sent to Admin</button>
                                    <?php } else { ?>
                                        <button type="button" data="<?= $position ?>" onclick="delegate_modal(this)" class="btn btn-primary btn-sm float-end" style="margin-left: 10px">Delegate to</button>
                                        <?php if ($status_job_profile == null) {?>
                                                <button type="button" data="modal_send_admin" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end">Send to Admin</button>
                                            <?php  } else {?>

                                            <?php if ($status_job_profile->status != null) {?>
                                                <button type="button" data="modal_send_admin" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end" style="margin-left: 10px">Send to Admin</button>
                                                <button type="button" class="btn btn-success btn-sm float-end" style="cursor:default;">Data Updated to Delegate</button>

                                            <?php } else if($status_job_profile->status == null) { ?>
                                                <button type="button" class="btn btn-warning btn-sm float-end">Waiting Send to Delegate</button>
                                            <?php } else  { ?>
                                            
                                            <?php  }?>
                                        <?php  }?>
                                    <?php  }?>
                            <?php  } ?>

                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    Job Desc Detail
                </div>
                <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" style="font-size: 12px; color:yellow;">
                        <li class="nav-item">
                            <button href="#tujuan" class="nav-link active" data-bs-toggle="tab">Tujuan Jabatan</button>
                        </li>
                        <li class="nav-item">
                            <button href="#tugas" onclick="navtab(this)" data="tugas" class="nav-link" data-bs-toggle="tab">Tugas & Tanggung Jawab</button>
                        </li>
                        <li class="nav-item">
                            <button href="#kewenangan" onclick="navtab(this)" data="kewenangan" class="nav-link" data-bs-toggle="tab">Kewenangan</button>
                        </li>
                        <li class="nav-item">
                            <button href="#kualifikasi" onclick="navtab(this)" data="kualifikasi" class="nav-link" data-bs-toggle="tab">Kualifikasi</button>
                        </li>
                        <li class="nav-item">
                            <button href="#kompetensi" onclick="navtab(this)" data="kompetensi" class="nav-link" data-bs-toggle="tab">Kompetensi</button>
                        </li>
                        <li class="nav-item">
                            <button href="#kpi" onclick="navtab(this)" data="kpi" class="nav-link" data-bs-toggle="tab">KPI</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tujuan">
                        <br>
                          <form id="form_<?= $tujuan ?>">
                            <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                            <input type="hidden" value="<?php echo (($tujuan_id) ? $tujuan_id->id_tujuan_jabatan : '') ?>" name="id">

                            <div class="mb-3 row">
                                <div class="form-group">
                                    <textarea name="tujuan" class="form-control" onkeyup="area(this)" id="input-tujuan" style="resize: none;" id="" cols="30" rows="5"><?php echo (($tujuan_id) ? $tujuan_id->tujuan : '') ?></textarea>
                                <span id="error"></span>
                                </div>
                            </div>

                            <button type="button" data="<?= $tujuan ?>" <?= $status_job_profile == null ? 'onclick="action_submit(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="action_submit(this)"') ?> class="btn btn-warning float-end btn_save_<?= $tujuan ?>">SAVE</button>
                        </form>
                        </div>
                        <div class="tab-pane fade" id="tugas">
                            <br>
                          <form id="form_<?= $tugas ?>">
                          <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                            <input type="hidden" value="<?= $tugas ?>" name="eksekutor">
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Nama Posisi</label>
                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                    <b><?= $id_job->position_name ?></b>
                                <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Job Family</label>
                                <div class="col-sm-7 form-group">
                                    <select onchange="check_v(this)" name="job_family" id="input-job_family" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                                    <option value="<?= (( $tugas_tanggung_jawab_id)? $tugas_tanggung_jawab_id->id_job_family : '' )?>" selected><?php echo (( $tugas_tanggung_jawab_id)? $tugas_tanggung_jawab_id->job_family : '' ) ?></option>
                                    <?php foreach($job_family as $data_family):?>
                                        <option value="<?= $data_family['id_job_family']?>"><?= $data_family['job_family']?></option>
                                    <?php endforeach; ?>

                                    </select>
                                <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Job Category</label>
                                <div class="col-sm-7 form-group">
                                    <select onchange="check_v(this)" name="job_category" id="input-job_category" class="form-select form-select-sm job_category" aria-label=".form-select-sm example">
                                    <option value="<?= (( $tugas_tanggung_jawab_id)? $tugas_tanggung_jawab_id->id_job_cateogory : '' )?>" selected><?php echo (( $tugas_tanggung_jawab_id)? $tugas_tanggung_jawab_id->job_category : '' ) ?></option>
                                    <?php foreach($job_category as $data_category):?>
                                        <option value="<?= $data_category['id']?>"><?= $data_category['job_category']?></option>
                                    <?php endforeach; ?>>
                                    </select>
                                    <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 form-group">
                                    <?php foreach($desc_tugas_tanggung_jawab_id as $data_desc_tugas_tanggung_jawab):?>
                                        <div id="inputFormRow_<?= $tugas ?>">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="field_<?= $tugas ?>[]" class="form-control form-control-sm m-input enter_<?= $tugas?>" value="<?= $data_desc_tugas_tanggung_jawab['description'] ?>" placeholder="" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button id="removeRow_<?= $tugas ?>" data="<?= $tugas ?>"  <?= $status_job_profile == null ? 'onclick="dels(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="dels(this)"') ?>  type="button" class="btn btn-danger btn-sm">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div id="newRow_<?= $tugas ?>"></div>
                                        <button id="addRow_<?= $tugas ?>" data="<?= $tugas ?>" <?= $status_job_profile == null ? 'onclick="tabs(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="tabs(this)"') ?>  type="button" class="btn btn-primary btn-sm">Add Row</button>
                                    <span id="error"></span>
                                </div>
                            </div>

                            <button type="button" data="<?= $tugas ?>" <?= $status_job_profile == null ? 'onclick="action_submit(this)"': ($status_job_profile->status != '3' ? 'disabled"' : 'onclick="action_submit(this)"') ?>  class="btn btn-warning float-end btn_save_<?= $tugas ?>">SAVE</button>
                            
                        </form>

                        </div>
                        <div class="tab-pane fade" id="kewenangan">
                        <br>
                          <form id="form_<?= $kewenangan ?>">
                            <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                            <input type="hidden" value="<?= $kewenangan ?>" name="eksekutor">

                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Nama Posisi</label>
                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                    <b><?= $id_job->position_name ?></b>
                                <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 form-group">
                                    <?php foreach($kewenangan_id as $data_kewenangan):?>

                                        <div id="inputFormRow_<?= $kewenangan ?>">
                                            <div class="input-group mb-3">
                                                <input type="text" name="field_<?= $kewenangan ?>[]"  value="<?= $data_kewenangan['kewenangan'] ?>" id="input-field_<?= $kewenangan ?>" class="form-control form-control-sm m-input enter_<?= $kewenangan?>"  autocomplete="off">
                                                <!-- <input type="hidden" name="hidden_<?= $kewenangan ?>[]"  value="<?= $data_kewenangan['id_kewenangan'] ?>" id="input-field_<?= $kewenangan ?>" class="form-control form-control-sm m-input enter_<?= $kewenangan?>"  autocomplete="off"> -->
                                                <div class="input-group-append">
                                                    <button id="removeRow_<?= $kewenangan ?>" data="<?= $kewenangan ?>" <?= $status_job_profile == null ? 'onclick="dels(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="dels(this)"') ?>  type="button" class="btn btn-danger btn-sm">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                        <div id="newRow_<?= $kewenangan ?>"></div>
                                        <button id="addRow_<?= $kewenangan ?>"  data="<?= $kewenangan ?>" <?= $status_job_profile == null ? 'onclick="tabs(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="tabs(this)"') ?>  type="button" class="btn btn-primary btn-sm">Add Row</button>
                                    <span id="error"></span>
                                </div>
                            </div>

                            <button type="button" disabled data="<?= $kewenangan ?>" <?= $status_job_profile == null ? 'onclick="action_submit(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="action_submit(this)"') ?>  class="btn btn-warning float-end btn_save_<?= $kewenangan ?>">SAVE</button>
                            
                        </form>
                        </div>
                        <div class="tab-pane fade" id="kualifikasi">
                        <br>
                          <form id="form_<?= $kualifikasi ?>">
                          <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">

                          <input type="hidden" value="<?= $kualifikasi ?>" name="eksekutor">

                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Nama Posisi</label>
                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                    <b><?= $id_job->position_name ?></b>
                                <span id="error"></span>
                                </div>
                            </div>
                            
                            <?php $no_tingkat = 1; $no_data = 1; $no_jurusan = 1;?>           
                            <?php foreach($kualifikasi_id as $data_kualifikasi):?>
                            <div id="inputFormRow_<?= $kualifikasi ?>">
                            <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                            <input type="hidden" value="<?= $kualifikasi ?>" name="eksekutor">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Tingkat Pendidikan</label>
                                        <select name="tingkat_pendidikan[]"  data="<?= $no_data++ ?>"  onchange="check_dropdown(this)" id="input-tingkat_pendidikan<?= $no_tingkat++ ?>"class="form-select form-select-sm" aria-label=".form-select-sm example" >
                                            <option value="<?= $data_kualifikasi['id_tingkat_pendidikan'] ?>"><?= $data_kualifikasi['edu_name'] ?></option>
                                            <?php foreach($tingkat_pendidikan as $tingkat):?>
                                                <option value="<?= $tingkat['id']?>"><?= $tingkat['edu_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="error"></span>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Jurusan</label>
                                        <select name="jurusan[]" id="input-jurusan" class="form-select form-select-sm jurusan<?= $no_jurusan++ ?>" aria-label=".form-select-sm example">
                                        <option value="<?= $data_kualifikasi['id_jurusan'] ?>"><?= $data_kualifikasi['edu_mjr'] ?></option>
                                            
                                        </select>
                                        <span id="error"></span>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Persyaratan Khusus</label>
                                        <input type="text" id="input-syarat" name="syarat[]" class="form-control form-control-sm" value="<?= $data_kualifikasi['persyaratan_khusus'] ?>">
                                        <span id="error"></span>
                                    </div>
                                    <div class="col-md-3 d-flex align-content-end flex-wrap">
                                        <button id="removeRow_<?= $kualifikasi ?>" data="<?= $kualifikasi ?>" <?= $status_job_profile == null ? 'onclick="dels(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="dels(this)"') ?> type="button" class="btn btn-danger btn-sm">Remove</button>
                                    </div>

                                </div>
                            </div>
                            <?php endforeach; ?>

                            <div id="newRow_<?= $kualifikasi ?>"></div>
                            <br>
                            <button id="addRow_<?= $kualifikasi ?>" data="<?= $kualifikasi ?>" <?= $status_job_profile == null ? 'onclick="tabs(this)"' : ($status_job_profile->status != '3' ? 'disabled' : 'onclick="tabs(this)"') ?>  type="button" class="btn btn-primary btn-sm">Add Row</button>
                            <br>
                            <label class="col-sm-5 col-form-label">Pengalaman Kerja</label>
                            <?php foreach($work_experience as $work):?>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="checkbox" name="description[]" <?= $status_job_profile == null ? :( $status_job_profile->status != '3' ? 'disabled' : '') ?> value="<?=  $work['id']?>" <?= (in_array($work['id'], $data_description)) ? 'checked' : ''?>>  <?= $work['description']?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <br>
                            <button type="button" disabled data="<?= $kualifikasi ?>" <?= $status_job_profile == null ? 'onclick="action_submit(this)"' : ($status_job_profile->status != '3' ? 'disabled' : 'onclick="action_submit(this)"') ?>  class="btn btn-warning float-end btn_save_<?= $kualifikasi ?>">SAVE</button>
                            
                        </form>
                        </div>
                        <div class="tab-pane fade" id="kompetensi">
                        <br>
                          <form id="form_<?= $kompetensi ?>">
                          <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                          <input type="hidden" value="<?= $kompetensi ?>" name="eksekutor">

                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Nama Posisi</label>
                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                    <b><?= $id_job->position_name ?></b>
                                <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 form-group">
                                        
                                        <?php foreach($kompetensi_id as $data_kompetensi):?>
                                            <div id="inputFormRow_<?= $kompetensi ?>">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="field_<?= $kompetensi ?>[]"  value="<?= $data_kompetensi['kompetensi'] ?>" class="form-control form-control-sm m-input enter_<?= $kompetensi?>" placeholder="" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button id="removeRow_<?= $kompetensi ?>" data="<?= $kompetensi ?>" <?= $status_job_profile == null ? ' onclick="dels(this)"': ($status_job_profile->status != '3' ? 'disabled' : ' onclick="dels(this)"') ?>  type="button" class="btn btn-danger btn-sm">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div id="newRow_<?= $kompetensi ?>"></div>
                                        <button id="addRow_<?= $kompetensi ?>" data="<?= $kompetensi ?>" <?= $status_job_profile == null ? 'onclick="tabs(this)"': ($status_job_profile->status != '3' ? 'disabled' : ' onclick="tabs(this)"') ?>  type="button" class="btn btn-primary btn-sm">Add Row</button>
                                    <span id="error"></span>
                                </div>
                            </div>

                            <button type="button" disabled data="<?= $kompetensi ?>" <?= $status_job_profile == null ? 'onclick="action_submit(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="action_submit(this)"') ?>  class="btn btn-warning float-end btn_save_<?= $kompetensi ?>">SAVE</button>
                            
                        </form>
                        </div>
                        <div class="tab-pane fade" id="kpi">
                        <br>
                          <form id="form_<?= $kpi ?>">
                          <input type="hidden" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="job_list_id">
                          <input type="hidden" value="<?= $kpi ?>" name="eksekutor">
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Nama Posisi</label>
                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                    <b><?= $id_job->position_name ?></b>
                                <span id="error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12 form-group">
                                        

                                        <?php foreach($kpi_id as $data_kpi):?>
                                            <div id="inputFormRow_<?= $kpi ?>">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="field_<?= $kpi ?>[]"  value="<?= $data_kpi['kpi'] ?>" class="form-control form-control-sm m-input enter_<?= $kpi?>" placeholder="" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button id="removeRow_<?= $kpi ?>" type="button" data="<?= $kpi ?>" <?= $status_job_profile == null ? 'onclick="dels(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="dels(this)"') ?>  class="btn btn-danger btn-sm">Remove</button>
                                                    </div>
                                                </div>
                                        </div>
                                        <?php endforeach; ?>

                                        <div id="newRow_<?= $kpi ?>"></div>
                                        <button id="addRow_<?= $kpi ?>" data="<?= $kpi ?>" <?= $status_job_profile == null ? 'onclick="tabs(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="tabs(this)"') ?>   type="button" class="btn btn-primary btn-sm">Add Row</button>
                                    <span id="error"></span>
                                </div>
                            </div>

                            <button type="button" disabled data="<?= $kpi ?>" <?= $status_job_profile == null ?  'onclick="action_submit(this)"': ($status_job_profile->status != '3' ? 'disabled' : 'onclick="action_submit(this)"') ?>   class="btn btn-warning float-end btn_save_<?= $kpi ?>">SAVE</button>
                            
                        </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
        </div>
       
    </div>
  </div>
</div>