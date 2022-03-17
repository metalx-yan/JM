<section class="body-content">
    <div class="row w-100">
        <div class="col-md-12">
            <div class=" ms-5 me-5">
                <div class="card-header bg-warning mb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6><?= $title_head ?></h6>
                        </div>
                        <div class="col-6 text-end">
                            <!-- <?= $access_crud['access_add'] ?> -->
                        </div>
                    </div>
                </div>
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

</section>