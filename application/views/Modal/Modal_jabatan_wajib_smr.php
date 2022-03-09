<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    <form  id="form_<?=$id?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Jabatan</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_jabatan" onkeyup="key(this)" value="<?php echo (( $kode_jabatan)? $kode_jabatan->kode_jabatan : '' ) ?>" name="kode_jabatan" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Kelompok</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-kode_kelompok" onkeyup="key(this)" value="<?php echo (( $kode_jabatan)? $kode_jabatan->kode_kelompok : '' ) ?>" name="kode_kelompok" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
            <select onchange="check_v(this)" id="input-kode_kelompok" name="kode_kelompok" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> class="form-select" aria-label="Default select example">
              <option value="<?php echo (( $kode_jabatan)? $kode_jabatan->kode_kelompok : '' ) ?>" selected><?php echo (( $kode_jabatan)? $kode_jabatan->kode_kelompok : '' ) ?></option>
              <option value="MNGR">MNGR</option>
              <option value="DIR">DIR</option>
            </select>
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Posisi atau Jabatan</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-posisi_jabatan" onkeyup="key(this)" value="<?php echo (( $kode_jabatan)? $kode_jabatan->posisi_jabatan : '' ) ?>" name="posisi_jabatan" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Wajib Sertifikasi SMR</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-wajib_sertifikasi_smr" onkeyup="key(this)" value="<?php echo (( $kode_jabatan)? $kode_jabatan->wajib_sertifikasi_smr : '' ) ?>" name="wajib_sertifikasi_smr" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
       
      </div>
      <div class="modal-footer">
      <button type="button" data="<?= $id?>" onclick="close_modal(this)"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data="<?= $id?>" onclick="action_submit(this)" class="btn <?php echo (( $id == 'modal_delete')? 'btn-danger' : 'btn-primary' ) ?>  action_add"><?php echo (( $id == 'modal_delete')? 'DELETE DATA' : 'SAVE CHANGES' ) ?></button>
      </div>
      </form>
    </div>
  </div>
</div>