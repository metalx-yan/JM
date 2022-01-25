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
            <label class="col-sm-5 col-form-label">Kode Fasilitator</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_fasilitator" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->kode_fasilitator : '' ) ?>" name="kode_fasilitator" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Fasilitator</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama_fasilitator" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->nama_fasilitator : '' ) ?>" name="nama_fasilitator" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">No Telepon</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-no_telepon" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->no_telepon : '' ) ?>" name="no_telepon" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Vendor</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_vendor" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->kode_vendor : '' ) ?>" name="kode_vendor" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kategori</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kategori" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->kategori : '' ) ?>" name="kategori" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">ID Internal</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-id_internal" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->id_internal : '' ) ?>" name="id_internal" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Jenis Fasilitator</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-jenis_fasilitator" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->jenis_fasilitator : '' ) ?>" name="jenis_fasilitator" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nomor Rekening</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-no_rekening" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->no_rekening : '' ) ?>" name="no_rekening" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Status</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-status" onkeyup="key(this)" value="<?php echo (( $kode_fasilitator)? $kode_fasilitator->status : '' ) ?>" name="status" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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