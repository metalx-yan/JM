<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Level Sertifikasi SMR</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-level_sertifikasi_smr" onkeyup="key(this)" value="<?php echo (($level_sertifikasi_smr) ? $level_sertifikasi_smr->level_sertifikasi_smr : '') ?>" name="level_sertifikasi_smr" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Masa Tenggang Sertifikasi</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-masa_tenggang_sertifikasi" onkeyup="key(this)" value="<?php echo (($level_sertifikasi_smr) ? $level_sertifikasi_smr->masa_tenggang_sertifikasi : '') ?>" name="masa_tenggang_sertifikasi" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
              <div id="error"></div>
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