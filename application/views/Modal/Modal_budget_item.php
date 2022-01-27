<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    <form  id="task">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
        <div class="mb-3 row">
            <!-- <label class="col-sm-5 col-form-label">Kode budget</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_budget" onkeyup="key(this)" value="<?php echo (( $kode_budget)? $kode_budget->kode_budget : '' ) ?>" name="kode_budget" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">keterangan budget</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-keterangan_budget" onkeyup="key(this)" value="<?php echo (( $kode_budget)? $kode_budget->keterangan_budget : '' ) ?>" name="keterangan_budget" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Jenis Budget</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-jenis_budget" onkeyup="key(this)" value="<?php echo (( $kode_budget)? $kode_budget->jenis_budget : '' ) ?>" name="jenis_budget" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nominal</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nominal" onkeyup="key(this)" value="<?php echo (( $kode_budget)? number_format($kode_budget->nominal) : '' ) ?>" name="nominal" class="form-control digitRupiah" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
       
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data="<?= $id?>" onclick="action_submit(this)" class="btn <?php echo (( $id == 'modal_delete')? 'btn-danger' : 'btn-primary' ) ?>  action_add"><?php echo (( $id == 'modal_delete')? 'DELETE DATA' : 'SAVE CHANGES' ) ?></button>
      </div>
      </form>
    </div>
  </div>
</div>