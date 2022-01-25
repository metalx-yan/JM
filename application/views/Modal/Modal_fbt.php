<div class="modal fade" id="edit_fbt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    <form action="<?= base_url('Setting_parameter/fasilitas_biaya_training_c/update_data')?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE DATA FASILITAS BIAYA TRAINING</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Fasilitas</label>
                    <div class="col-sm-7">
                    <input type="text" name="kode_fasilitas" value="<?= $data_fbt->kode_fasilitas?>" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Lokasi</label>
                    <div class="col-sm-7">
                    <input type="text"  name="kode_lokasi" value="<?= $data_fbt->kode_lokasi?>" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Cabang Peserta</label>
                    <div class="col-sm-7">
                    <input type="text" name="kode_cabang_peserta" value="<?= $data_fbt->kode_cabang_peserta?>" class="form-control">
                    </div>
                </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>