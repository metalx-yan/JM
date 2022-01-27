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
            <!-- <label class="col-sm-5 col-form-label">Kode Unit</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_transportasi" onkeyup="key(this)" value="<?php echo (( $kode_transportasi)? $kode_transportasi->kode_transportasi : '' ) ?>" name="kode_transportasi" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Pangkat</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_pangkat" onkeyup="key(this)" value="<?php echo (( $kode_transportasi)? $kode_transportasi->kode_pangkat : '' ) ?>" name="kode_pangkat" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kelas Transportasi</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-kelas_transportasi" onkeyup="key(this)" value="<?php echo (( $kode_transportasi)? $kode_transportasi->kelas_transportasi : '' ) ?>" name="kelas_transportasi" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->

            <select onchange="check_v(this)" id="input-kelas_transportasi" name="kelas_transportasi" required class="form-select"  <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> aria-label="Default select example">
              <option value="<?php echo (( $kode_transportasi)? $kode_transportasi->kelas_transportasi : '' ) ?>" selected><?php echo (( $kode_transportasi)? $kode_transportasi->kelas_transportasi : '' ) ?></option>
              <option value="VIP">VIP</option>
              <option value="Reguler">Reguler</option>
            </select>
            <div id="error"></div>
            </div>
        </div>


        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nilai Nominal</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nilai_nominal" onkeyup="key(this)" value="<?php echo (( $kode_transportasi)? number_format($kode_transportasi->nilai_nominal) : '' ) ?>" name="nilai_nominal" class="form-control digitRupiah" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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
