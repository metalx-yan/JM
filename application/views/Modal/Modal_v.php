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
            <!-- <label class="col-sm-5 col-form-label">Kode Lokasi</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_fasilitas" onkeyup="key(this)" value="<?php echo (( $kode_fasilitas)? $kode_fasilitas->kode_fasilitas : '' ) ?>" name="kode_fasilitas" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Lokasi</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-kode_lokasi" onkeyup="key(this)" value="<?php echo (( $kode_fasilitas)? $kode_fasilitas->kode_lokasi : '' ) ?>" name="kode_lokasi" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> > -->
            <select name="kode_lokasi" id="input-kode_lokasi" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
              <option value="<?= (( $kode_fasilitas)? $kode_fasilitas->kode_lokasi : '' )?>"  selected><?php echo (( $kode_fasilitas)? $kode_fasilitas->nama_tempat : '' ) ?></option>
              <?php foreach($kode_lokasi as $lokasi):?>
                <option value="<?= $lokasi['kode_lokasi']?>"><?= $lokasi['nama_tempat']; ?></option>
              <?php endforeach; ?>
            </select>
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Cabang Peserta</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_cabang_peserta" onkeyup="key(this)" value="<?php echo (( $kode_fasilitas)? $kode_fasilitas->kode_cabang_peserta : '' ) ?>" name="kode_cabang_peserta" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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