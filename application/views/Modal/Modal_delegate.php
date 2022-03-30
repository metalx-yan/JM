<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="delegate" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <form id="form_<?= $id ?>">
                    <input type="hidden" name="id" value="<?= $position_id ?>">
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
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Delegate to</label>
                        <div class="col-sm-7 form-group">
                            <select onchange="check_v(this)" name="delegate" id="input-delegate" class="form-select form-select-sm delegate" aria-label=".form-select-sm example">
                                <option value="<?= (( $query_delegate)? $query_delegate->user_name : '' )?>" selected><?php echo (( $query_delegate)? $query_delegate->singkatan .' - '. $query_delegate->nama .' - '. $query_delegate->job_title : '' ) ?></option>

                                <?php foreach($is_admin as $admin):?>
                                    <?php foreach($delegate as $delegate):?>
                                        <?php if ($admin['user_name'] == $delegate['user_name']) { ?>
                                        <?php }  else { ?> 
                                            <option value="<?= $delegate['user_name']?>"><?= $delegate['singkatan'].' - '?> <div style="font-weight: bold;"><?= $delegate['nama']?></div> <?=  ' - '.$delegate['job_title']?></option>
                                        <?php } ?> 
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                            <span id="error"></span>
                        </div>
                    </div>

                    <div class="">
                    <?php if ($status_job_profile == null) {?>
                        <button type="button" data="modal_delegate" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end">Send</button>

                    <?php  } else {?>
                            <?php if ($status_job_profile->delegate_to != NULL) { ?>
                                <button type="button" class="btn btn-warning btn-sm float-end" style="cursor:default;">Sent</button>
                            <?php } else { ?>
                                <input type="hidden" value="<?= $position ?>" name="id">
                                
                                <button type="button" data="modal_delegate" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end">Send</button>
                            <?php } ?> 
                    <?php } ?> 

                            
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>