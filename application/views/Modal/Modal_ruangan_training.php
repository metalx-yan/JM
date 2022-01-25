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
            <!-- <label class="col-sm-5 col-form-label">Kode Ruangan</label> -->
            <div class="col-sm-7 form-group">
            <input type="hidden" id="input-kode_ruangan" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->kode_ruangan : '' ) ?>" name="kode_ruangan" class="form-control" required <?php echo (( $id == 'modal_edit' || $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Nama Ruangan</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-nama_ruangan" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->nama_ruangan : '' ) ?>" name="nama_ruangan" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Lantai</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-lantai" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->lantai : '' ) ?>" name="lantai" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kode Lokasi</label>
            <div class="col-sm-7 form-group">
            <!-- <input type="text" id="input-kode_lokasi" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->kode_lokasi : '' ) ?>" name="kode_lokasi" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> > -->
            <select name="kode_lokasi" id="input-kode_lokasi" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
              <option value="<?= (( $kode_ruangan)? $kode_ruangan->kode_lokasi : '' )?>"  selected><?php echo (( $kode_ruangan)? $kode_ruangan->nama_tempat : '' ) ?></option>
              <?php foreach($kode_lokasi as $lokasi):?>
                <option value="<?= $lokasi['kode_lokasi']?>"><?= $lokasi['nama_tempat']; ?></option>
              <?php endforeach; ?>
            </select>
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kapasitas Ruangan</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kapasitas_ruangan" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->kapasitas_ruangan : '' ) ?>" name="kapasitas_ruangan" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Kursi</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-kursi" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->kursi : '' ) ?>" name="kursi" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Meja</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-meja" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->meja : '' ) ?>" name="meja" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Komputer</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-komputer" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->komputer : '' ) ?>" name="komputer" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Proyektor</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-proyektor" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->proyektor : '' ) ?>" name="proyektor" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
            <div id="error"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">White Board</label>
            <div class="col-sm-7 form-group">
            <input type="text" id="input-white_board" onkeyup="key(this)" value="<?php echo (( $kode_ruangan)? $kode_ruangan->white_board : '' ) ?>" name="white_board" class="form-control" required <?php echo (( $id == 'modal_delete')? 'readonly' : '' ) ?> >
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