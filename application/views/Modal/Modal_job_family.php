<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <div class="col-sm-7 form-group">
              <input type="hidden" id="input-id_job_family" onkeyup="key(this)" value="<?php echo (($id_job_family) ? $id_job_family->id_key : '') ?>" name="id_job_family" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Family</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_family" id="input-job_family" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
                <option value="<?= (( $id_job_family)? $id_job_family->id_job_family : '' )?>" selected><?php echo (( $id_job_family)? $id_job_family->job_family : '' ) ?></option>
                <?php foreach($job_family as $jobfamily):?>
                    <option value="<?= $jobfamily['id_job_family']?>"><?= $jobfamily['job_family']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Sub Family</label>
            <div class="col-sm-7 form-group">
                <input type="text" id="input-job_sub_family" onkeyup="key(this)" value="<?php echo (($id_job_family) ? $id_job_family->job_sub_family : '') ?>" name="job_sub_family" class="form-control" required <?php echo (($id == 'modal_delete') ? 'readonly' : '') ?>>
              <span id="error"></span>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" data="<?= $id ?>" onclick="action_submit(this)" class="btn <?php echo (($id == 'modal_delete') ? 'btn-danger' : 'btn-primary') ?>  action_add"><?php echo (($id == 'modal_delete') ? 'DELETE DATA' : 'SAVE CHANGES') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>