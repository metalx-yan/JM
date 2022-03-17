<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3 row">
          <div class="col-sm-7 form-group">
            <div id="error"></div>
          </div>
        </div>

        <div class="modal-body">
      
                    <div class="col-md-12 row">
                        <b>1. Tugas & Tanggung Jawab</b>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach($tanggung_jawab as $tugas):?>
                                <ul>
                                    <li><?= $tugas['description'] ?></li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 row">
                        <b>2. Kewenangan</b>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach($kewenangan as $kewenangan):?>
                                <ul>
                                    <li><?= $kewenangan['kewenangan'] ?></li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 row">
                        <b>3. Kualifikasi Jabatan</b>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <b>Pendidikan</b>
                            <?php foreach($pengalaman_kerja as $kerja):?>
                                <ul>
                                    <li><?= $kerja['description'] ?></li>
                                </ul>
                            <?php endforeach; ?>
                            <b>Kompetensi yang dibutuhkan</b>
                            <?php foreach($kompetensi as $kompetensi):?>
                                <ul>
                                    <li><?= $kompetensi['kompetensi'] ?></li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" data="<?= $id ?>" onclick="close_modal(this)" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>