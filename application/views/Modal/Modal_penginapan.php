<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <!-- <label class="col-sm-5 col-form-label">Kode Unit</label> -->
            <div class="col-sm-7 form-group">
              <input type="hidden" id="input-kode_penginapan" onkeyup="key(this)" value="<?php echo (($kode_penginapan) ? $kode_penginapan->kode_penginapan : '') ?>" name="kode_penginapan" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Pangkat</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-kode_pangkat" onkeyup="key(this)" value="<?php echo (($kode_penginapan) ? $kode_penginapan->kode_pangkat : '') ?>" name="kode_pangkat" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Sharing Kamar</label>
            <div class="col-sm-7 form-group">
              <!-- <input type="text" id="input-sharing_kamar" onkeyup="key(this)" value="<?php echo (($kode_penginapan) ? $kode_penginapan->sharing_kamar : '') ?>" name="sharing_kamar" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> > -->

              <select onchange="check_v(this)" id="input-sharing_kamar" name="sharing_kamar" required class="form-select" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> aria-label="Default select example">
                <option value="<?php echo (($kode_penginapan) ? $kode_penginapan->sharing_kamar : '') ?>" selected><?php echo (($kode_penginapan) ? $kode_penginapan->sharing_kamar : '') ?></option>
                <option value="YA">YA</option>
                <option value="TIDAK">TIDAK</option>
              </select>
              <div id="error"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kelas Penginapan</label>
            <div class="col-sm-7 form-group">
              <!-- <input type="text" id="input-kelas_penginapan" onkeyup="key(this)" value="<?php echo (($kode_penginapan) ? $kode_penginapan->kelas_penginapan : '') ?>" name="kelas_penginapan" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> > -->

              <select onchange="check_v(this)" id="input-kelas_penginapan" name="kelas_penginapan" required class="form-select" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> aria-label="Default select example">
                <option value="<?php echo (($kode_penginapan) ? $kode_penginapan->kelas_penginapan : '') ?>" <?php echo (($kode_penginapan) ? 'readonly' : '') ?> selected><?php echo (($kode_penginapan) ? $kode_penginapan->kelas_penginapan : '') ?></option>
                <option value="Bintang 5">Bintang 5</option>
                <option value="Bintang 4">Bintang 4</option>
                <option value="Bintang 3">Bintang 3</option>
                <option value="Bintang 2">Bintang 2</option>
                <option value="Bintang 1">Bintang 1</option>
              </select>
              <div id="error"></div>
            </div>
          </div>


          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nilai Nominal</label>
            <div class="col-sm-7 form-group">
              <input type="text" id="input-nilai_nominal" onkeyup="key(this)" value="<?php echo (($kode_penginapan) ? number_format($kode_penginapan->nilai_nominal) : '') ?>" name="nilai_nominal" class="form-control digitRupiah" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
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