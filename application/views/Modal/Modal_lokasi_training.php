<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <div class="col-sm-7 form-group">
              <input type="hidden" id="input-kode_lokasi" onkeyup="key(this)" value="<?php echo (($kode_lokasi) ? $kode_lokasi->kode_lokasi : '') ?>" name="kode_lokasi" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Tempat</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-nama_tempat" onkeyup="key(this)" value="<?php echo (($kode_lokasi) ? $kode_lokasi->nama_tempat : '') ?>" name="nama_tempat" class="form-control" required <?php echo (($id == 'modal_delete') ? 'readonly' : '') ?>>

              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Alamat</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-alamat" onkeyup="key(this)" value="<?php echo (($kode_lokasi) ? $kode_lokasi->alamat : '') ?>" name="alamat" class="form-control" required <?php echo (($id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kategori</label>
            <div class="col-sm-7 form-group">
              <select onchange="check_v(this)" name="kategori" id="input-kategori" class="form-select" aria-label="Default select example" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
                <option value="<?php echo (($kode_lokasi) ? $kode_lokasi->kategori : '') ?>" selected><?php echo (($kode_lokasi) ? $kode_lokasi->kategori : '') ?></option>
                <option value="Training Center">Training Center</option>
                <option value="Hotel">Hotel</option>
              </select>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kota</label>
            <div class="col-sm-7 form-group">
              <select onchange="check_v(this)" name="kota" id="input-kota" class="form-select" aria-label="Default select example" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
                <option value="<?php echo (($kode_lokasi) ? $kode_lokasi->kota : '') ?>" selected><?php echo (($kode_lokasi) ? $kode_lokasi->kota : '') ?></option>
                <option value="Data Kota">Data Kota 1</option>
                <option value="Data Kota 2">Data Kota 2</option>
              </select>
              <div id="error"></div>
            </div>
          </div>



        </div>
        <div class="modal-footer">
        <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" data="<?= $id ?>" onclick="action_submit(this)" class="btn <?php echo (($id == 'modal_delete') ? 'btn-danger' : 'btn-primary') ?>  action_add"><?php echo (($id == 'modal_delete') ? 'DELETE DATA' : 'SAVE CHANGES') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>