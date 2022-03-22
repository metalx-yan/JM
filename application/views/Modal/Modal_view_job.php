<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
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
        <section class="body-content">
  
                <div class="card-body">
                    <div class="col-md-12 row">
                        <b>1. Profile Jabatan</b>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Nama Posisi </b>
                                        </div>
                                        <div class="col-md-6">
                                            <div><?= $data_profile->position_name ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Nama Job </b>
                                        </div>
                                        <div class="col-md-6">
                                            <div><?= $data_profile->job_title ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Job Function </b>
                                        </div>
                                        <div class="col-md-6">
                                            <div><?= $data_profile->job_function ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Job Family </b>
                                        </div>
                                        <div class="col-md-6">
                                            <div><?= $data_profile->job_family ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 row">
                        <b>2. Tugas & Tanggung Jawab</b>
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
                        <b>3. Kewenangan</b>
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
                        <b>4. Kualifikasi Jabatan</b>
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
             
        </div>
    </div>
  </div>
  </div>