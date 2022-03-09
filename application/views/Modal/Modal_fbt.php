<div class="modal fade" id="<?= $id ?>">
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
              <input type="hidden" id="input-kode_fasilitas" onkeyup="key(this)" value="<?php echo (($kode_fasilitas) ? $kode_fasilitas->kode_fasilitas : '') ?>" name="kode_fasilitas" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Lokasi</label>
            <div class="col-sm-7 form-group">
              <select onchange="check_v(this)" name="kode_lokasi" id="input-kode_lokasi" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> required>
                <option value="<?= (($kode_fasilitas) ? $kode_fasilitas->kode_lokasi : '') ?>" selected><?php echo (($kode_fasilitas) ? $kode_fasilitas->nama_tempat : '') ?></option>
                <?php foreach ($kode_lokasi as $lokasi) : ?>
                  <option value="<?= $lokasi['kode_lokasi'] ?>"><?= $lokasi['nama_tempat']; ?></option>
                <?php endforeach; ?>
              </select>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Cabang Peserta</label>
            <div class="col-sm-7 form-group">
              <select onchange="check_v(this)" name="kode_cabang" id="input-kode_cabang" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> required>
                <option value="<?= (($kode_fasilitas) ? $kode_fasilitas->kode_cabang : '') ?>" selected><?php echo (($kode_fasilitas) ? $kode_fasilitas->nama_cabang : '') ?></option>
                <?php foreach ($kode_cabang as $lokasi) : ?>
                  <option value="<?= $lokasi['kode_cabang'] ?>"><?= $lokasi['nama_cabang']; ?></option>
                <?php endforeach; ?>
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