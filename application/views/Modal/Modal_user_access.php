<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="user_name" value="<?php  echo (($id_job) ? $id_job->user_name: '') ?>">
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama</label>
            <div class="col-sm-7 form-group">
                <input list="encodings" type="text" id="input-nama" onkeyup="key(this)" value="<?php  echo (($id_job) ? $id_job->user_name . '-' . $id_job->nama : '') ?>" name="nama" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
                <datalist id="encodings">
                    <?php foreach($list_user as $useacc):?>
                            <?php if (!in_array($useacc['user_name'],$array_user_name)) {?>
                                <option value="<?= $useacc['user_name'] . '-' . $useacc['nama']?>"><?= $useacc['user_name'] .'-'. $useacc['nama']; ?></option>
                            <?php } else {?>
                            <?php } ?>
                        <?php endforeach; ?>
                </datalist>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Access</label>
            <div class="col-sm-7 form-group">
                <select onchange="check_v(this)" name="access" id="input-access" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
                    <option value="<?php echo (( $id_job) ? $id_job->jabatan : '' )?>" ><?php echo (( $id_job) ? $access : '' )?></option>
                    <option value="100">Admin</option>
                    <option value="101">PUK Tertinggi</option>
                    <option value="102">HCBP</option>
                </select>
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