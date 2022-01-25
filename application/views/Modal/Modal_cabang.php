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
            <!-- <label class="col-sm-5 col-form-label">Kode Cabang</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_cabang" onkeyup="key(this)" value="<?php echo (( $kode_cabang)? $kode_cabang->kode_cabang : '' ) ?>" name="kode_cabang" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Cabang</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama_cabang" onkeyup="key(this)" value="<?php echo (( $kode_cabang)? $kode_cabang->nama_cabang : '' ) ?>" name="nama_cabang" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Regional</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-regional" onkeyup="key(this)" value="<?php echo (( $kode_cabang)? $kode_cabang->regional : '' ) ?>" name="regional" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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