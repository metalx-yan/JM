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
            <!-- <label class="col-sm-5 col-form-label">Kode Vendor</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_vendor" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->kode_vendor : '' ) ?>" name="kode_vendor" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->nama : '' ) ?>" name="nama" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Alamat</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-alamat" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->alamat : '' ) ?>" name="alamat" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">No Telepon</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-no_telepon" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->no_telepon : '' ) ?>" name="no_telepon" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">PIC</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-pic" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->pic : '' ) ?>" name="pic" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Tipe</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-tipe" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->tipe : '' ) ?>" name="tipe" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
              <select  name="tipe" id="input-tipe" class="form-select" aria-label="Default select example" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?>>
                <option value="<?php echo (( $kode_vendor)? $kode_vendor->tipe : '' ) ?>" selected><?php echo (( $kode_vendor)? $kode_vendor->tipe : '' ) ?></option>
                <option value="Internal">Internal</option>
                <option value="External">External</option>
              </select>
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Perusahaan</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama_perusahaan" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->nama_perusahaan : '' ) ?>" name="nama_perusahaan" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Bisnis Unit</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-bisnis_unit" onkeyup="key(this)" value="<?php echo (( $kode_vendor)? $kode_vendor->bisnis_unit : '' ) ?>" name="bisnis_unit" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
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