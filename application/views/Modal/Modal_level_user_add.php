<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" id="input-id" onkeyup="key(this)" value="<?php echo (($name_level_user) ? $name_level_user->id : '') ?>" name="id" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Level User</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-level_user" onkeyup="key(this)" value="<?php echo (($name_level_user) ? $name_level_user->level_user : '') ?>" name="level_user" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
              <div id="error"></div>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" data="<?= $id ?>" onclick="add_level_user(this)" class="btn btn-primary">SAVE CHANGES</button>
        </div>
      </form>
    </div>
  </div>
</div>