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
            <input type="hidden" id="input-kode_uang_saku" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->kode_uang_saku : '' ) ?>" name="kode_uang_saku" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Pangkat</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kode_pangkat" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->kode_pangkat : '' ) ?>" name="kode_pangkat" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Keterangan Peserta / Fasilitator</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-keterangan_peserta" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->keterangan_peserta : '' ) ?>" name="keterangan_peserta" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->

            <select onchange="check_v(this)" id="input-keterangan_peserta" name="keterangan_peserta" required class="form-select"  <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> aria-label="Default select example">
              <option value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->keterangan_peserta : '' ) ?>" selected><?php echo (( $kode_uang_saku)? $kode_uang_saku->keterangan_peserta : '' ) ?></option>
              <option value="Peserta">Peserta</option>
              <option value="Fasilitator">Fasilitator</option>
            </select>
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Dalam / Luar Negeri</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-dalam_luar_negeri" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->dalam_luar_negeri : '' ) ?>" name="dalam_luar_negeri" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
            <select onchange="check_v(this)" id="input-dalam_luar_negeri" name="dalam_luar_negeri" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> class="form-select" aria-label="Default select example">
              <option value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->dalam_luar_negeri : '' ) ?>" selected><?php echo (( $kode_uang_saku)? $kode_uang_saku->dalam_luar_negeri : '' ) ?></option>
              <option value="dalam_negeri">Dalam Negeri</option>
              <option value="luar_negeri">Luar Negeri</option>
            </select>
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Tujuan Negara</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-tujuan_negara" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->tujuan_negara : '' ) ?>" name="tujuan_negara" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
            <select onchange="check_v(this)" id="input-tujuan_negara" name="tujuan_negara" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> class="form-select" aria-label="Default select example">
              <option value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->tujuan_negara : '' ) ?>" selected><?php echo (( $kode_uang_saku)? $kode_uang_saku->tujuan_negara : '' ) ?></option>
              <option value="Singapore">Singapore</option>
              <option value="Australia">Australia</option>
            </select>
            <span id="error"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Uang Makan</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-uang_makan" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->uang_makan : '' ) ?>" name="uang_makan" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
            <select onchange="check_v(this)" id="input-uang_makan" name="uang_makan" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> class="form-select" aria-label="Default select example">
              <option value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->uang_makan : '' ) ?>" selected><?php echo (( $kode_uang_saku)? $kode_uang_saku->uang_makan : '' ) ?></option>
              <option value="Di Tanggung Penyelenggara">Di Tanggung Penyelenggara</option>
              <option value="Tidak di Tanggung Penyelenggara">Tidak di Tanggung Penyelenggara</option>
            </select>
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nilai Nominal</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nilai_nominal" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? number_format($kode_uang_saku->nilai_nominal) : '' ) ?>" name="nilai_nominal" class="form-control digitRupiah" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Mata Uang</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-mata_uang" onkeyup="key(this)" value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->mata_uang : '' ) ?>" name="mata_uang" class="form-control" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> > -->
            <select onchange="check_v(this)" id="input-mata_uang" name="mata_uang" required <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> class="form-select" aria-label="Default select example">
              <option value="<?php echo (( $kode_uang_saku)? $kode_uang_saku->mata_uang : '' ) ?>" selected><?php echo (( $kode_uang_saku)? $kode_uang_saku->mata_uang : '' ) ?></option>
              <option value="IDR">IDR</option>
              <option value="USA">USA</option>
            </select>
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
