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
            <!-- <label class="col-sm-5 col-form-label">Kode Program</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_program" onkeyup="key(this)" value="<?php echo (( $kode_program)? $kode_program->kode_program : '' ) ?>" name="kode_program" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Program</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama_program" onkeyup="key(this)" value="<?php echo (( $kode_program)? $kode_program->nama_program : '' ) ?>" name="nama_program" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Jenis Program</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-jenis_program" onkeyup="key(this)" value="<?php echo (( $kode_program)? $kode_program->jenis_program : '' ) ?>" name="jenis_program" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Keterangan Program</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-keterangan_program" onkeyup="key(this)" value="<?php echo (( $kode_program)? $kode_program->keterangan_program : '' ) ?>" name="keterangan_program" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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