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
            <!-- <label class="col-sm-5 col-form-label">Kode Unit</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_insentif" onkeyup="key(this)" value="<?php echo (( $kode_insentif)? $kode_insentif->kode_insentif : '' ) ?>" name="kode_insentif" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Range Nilai</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-range_nilai" onkeyup="key(this)" value="<?php echo (( $kode_insentif)? $kode_insentif->range_nilai : '' ) ?>" name="range_nilai" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nominal Insentif Hari Kerja</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nominal_insentif_hari_kerja" onkeyup="key(this)" value="<?php echo (( $kode_insentif)? number_format($kode_insentif->nominal_insentif_hari_kerja) : '' ) ?>" name="nominal_insentif_hari_kerja" class="form-control digitRupiah" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nominal Insentif Hari Libur</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nominal_insentif_hari_libur" onkeyup="key(this)" value="<?php echo (( $kode_insentif)? number_format($kode_insentif->nominal_insentif_hari_libur) : '' ) ?>" name="nominal_insentif_hari_libur" class="form-control digitRupiah" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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
