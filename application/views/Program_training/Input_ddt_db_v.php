<section class="content" style="margin:-40px 0 0 0 ;">
    <div class="row title-content bg-warning m-3 p-2">
        <div class="col-12">
            <h5>Input Detail Training dan Detail Budget</h5>
        </div>
    </div>
    <div class="row ms-3 me-3">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12 border-bottom border-2 border-info">
                    <strong>MD Pengajuan Training</strong>
                </div>
            </div>
            <div class="mb-1 mt-2 row">
                <div class="col-sm-3">
                    No. MD</div>
                <div class="col-sm-9">
                    : <?= $get_data->nomor_pengajuan ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Tanggal MD</div>
                <div class="col-sm-9">
                    : <?= $get_data->tgl_pengajuan ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Perihal</div>
                <div class="col-sm-9">
                    : <?= $get_data->perihal ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Dari</div>
                <div class="col-sm-9">
                    : <?= $get_data->unit_kerja ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Hari / Tanggal</div>
                <div class="col-sm-9">
                    : <?= $get_data->tgl_pelaksanaan_awal ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Waktu</div>
                <div class="col-sm-9">
                    : hh:mm s/d hh:mm
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Lokasi</div>
                <div class="col-sm-9">
                    : <?= $get_data->alamat_training ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Fasilitor</div>
                <div class="col-sm-9">
                    : <?= $get_data->fasilitator ?>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Jml. Peserta</div>
                <div class="col-sm-9">
                    : <?= $get_data->jml_peserta ?> <button class="btn ms-5 btn-sm btn-primary" value="<?= $get_data->nomor_pengajuan ?>" onclick="views()">Tampilkan</button>
                </div>
            </div>
            <div class="mb-1 row">
                <div class="col-sm-3">
                    Kelompok</div>
                <div class="col-sm-9">
                    : <?= $get_data->jenis_training ?>
                </div>
            </div>

            <div class="row mt-3 border-bottom border-2 border-info">
                <div class="col-md-4"><Strong>Detail Training</Strong></div>
                <div class="col-md-2">
                    <input disabled class="form-check-input" <?= ($get_data->training == "OFFLINE") ? 'checked' : ''; ?> type="radio" name="flexRadioDefault" id="flexRadioDefault1">Offline
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <input disabled class="form-check-input" <?= ($get_data->training == "ONLINE") ? 'checked' : ''; ?> type="radio" name="flexRadioDefault" id="flexRadioDefault1">Online
                </div>
            </div>

            <div class="mb-3 mt-2 row">
                <div class="col-sm-3">
                    Program Training</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($program_training as $pt) : ?>
                            <option value="<?= $pt['kode_program'] ?>"><?= $pt['nama_program'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Jenis Pelatihan</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($jenis_pelatihan as $jp) : ?>
                            <option value="<?= $pt['kode_pelatihan'] ?>"><?= $pt['nama_pelatihan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Batch/Angkatan</div>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Nama Vendor</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($vendor as $v) : ?>
                            <option value="<?= $v['kode_vendor'] ?>"><?= $v['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Status Vendor</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($status_vendor as $sv) : ?>
                            <option value="<?= $sv['kode_status'] ?>"><?= $sv['keterangan_status'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Fasilitator</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($fasilitator as $f) : ?>
                            <option value="<?= $f['kode_fasilitator'] ?>"><?= $f['nama_fasilitator'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Penyelenggara</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($penyelenggara as $p) : ?>
                            <option value="<?= $p['kode_penyelenggara'] ?>"><?= $p['keterangan_penyelenggara'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Jumlah Hari</div>
                <div class="col-sm-9">
                    <input type="text" value="<?= $get_data->durasi ?>" class="form-control form-control-sm" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-3">
                            Hari Kerja
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-3">
                            Hari Libur
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    Ruangan</div>
                <div class="col-sm-9">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="0" selected>-- PILIH --</option>
                        <?php foreach ($ruangan_training as $rt) : ?>
                            <option value="<?= $rt['kode_ruangan'] ?>"><?= $rt['nama_ruangan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalSusunan" style="width:100%">
                        Susunan Acara dan Waktu
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12  border-bottom border-2 border-info">
                    <strong>Detail Budget</strong>
                </div>
            </div>

            <div class="row title-content mt-1 p-1">
                <div class="col-md-12">
                    <strong>Input Detail Training dan Detail Budget</strong>
                </div>
            </div>

            <div class="row " id="appVue">
                <div class="col-md-11 table-responsive">
                    <table width="100%" class="table table-bordered align-middle">

                        <thead>
                            <tr class="text-center bg-info">
                                <th scope="row">No</th>
                                <th>Route/Description</th>
                                <th>Peserta</th>
                                <th>Hari/Jam</th>
                                <th>Harga (Rp)</th>
                                <th>Total Harga (Rp)</th>
                                <th>Keterangan</th>
                            </tr>

                        </thead>

                        <tbody>
                            <component v-for="(component, index) in components" :key="index" :is="component" />
                        </tbody>


                        <tfoot>

                            <tr>
                                <td colspan="5" class="text-end">Subtotal Biaya Operasional Rp.</td>
                                <td><input type="number" class="border-0 form-control form-control-sm" name="subtotal"></td>
                                <td></td>
                            </tr>
                            
                        </tfoot>

                    </table>

                </div>

                <div class="col-md-1 d-flex align-items-center">
                    <i class="bi bi-plus-circle" @click="add" style="cursor:pointer"></i>
                </div>
            </div>

            <!-- Biaya SPJ & Akomodasi -->
            <div class="row title-content mt-1 p-1">
                <div class="col-md-12">
                    <strong>Biaya SPJ & Akomodasi</strong>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-11">
                    <table width="100%" class="table table-bordered align-middle">
                        <tr class="text-center bg-info">
                            <th scope="row">No</th>
                            <th>Route/Description</th>
                            <th>Peserta</th>
                            <th>Hari/Jam</th>
                            <th>Harga (Rp)</th>
                            <th>Total Harga (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php
                        for ($i = 1; $i < 3; $i++) {
                            $no = 0;
                            $no += $i;
                        ?>
                            <tr class="tax">
                                <td><?= $no ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }
                        ?>
                        </tr>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end">Subtotal Biaya SPJ & Akomodasi Rp.</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-md-1 d-flex align-items-center">
                    <i class="bi bi-plus-circle"></i>
                </div>

            </div>

            <!-- Biaya Transportasi -->
            <div class="row title-content mt-1 p-1">
                <div class="col-md-12">
                    <strong>Biaya Transportasi</strong>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-11">
                    <table width="100%" class="table table-bordered align-middle">
                        <tr class="text-center bg-info">
                            <th scope="row">No</th>
                            <th>Route/Description</th>
                            <th>Peserta</th>
                            <th>Hari/Jam</th>
                            <th>Harga (Rp)</th>
                            <th>Total Harga (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php
                        for ($i = 1; $i < 2; $i++) {
                            $no = 0;
                            $no += $i;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }
                        ?>
                        </tr>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end">Subtotal Biaya Transportasi Rp.</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-md-1 d-flex align-items-center">
                    <i class="bi bi-plus-circle"></i>
                </div>

            </div>

            <div class="row align-middle mt-5">
                <div class="col-md-7">
                    <div class="row mb-3 ">
                        <div class="col-md-6">
                            Total Budget
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            Total Uang saku & SPJ
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            Biaya Lain - lain
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Grand Total Budget</strong>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>AVG/Peserta</strong>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-5 mt-4">
                <div class="col-md-12 text-center">
                    <button class="btn btn-warning me-4">Kirim</button>
                    <a href="<?= base_url('Program_training/Proses_pengajuan_training_c') ?>"><button class="btn btn-warning">Batal</button></a>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Peserta -->
    <div id="modal_detail_peserta">

    </div>


    <!-- Modal Susunan Acara & Waktu Training -->
    <div class="modal fade" id="modalSusunan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
                <div class="modal-body">

                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                            <strong>Susuanan Acara dan Waktu Training</strong>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="align-middle bg-info">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Hari/Tanggal</th>
                                        <th rowspan="2">Sesi</th>
                                        <th colspan="2">Waktu</th>
                                        <th rowspan="2">Materi</th>
                                        <th rowspan="2">Fasilitator</th>
                                    </tr>
                                    <tr>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 1; $i < 3; $i++) { ?>

                                        <tr>
                                            <td rowspan="4"><?= $i ?></td>
                                            <td rowspan="4"></td>
                                            <td>1</td>
                                            <td>hh:mm</td>
                                            <td>hh:mm</td>
                                            <td>xxxxx</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>hh:mm</td>
                                            <td>hh:mm</td>
                                            <td>xxxxx</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>hh:mm</td>
                                            <td>hh:mm</td>
                                            <td>xxxxx</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>hh:mm</td>
                                            <td>hh:mm</td>
                                            <td>xxxxx</td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</section>

<script>
    const Comp = {
        template: '<tr> <td>2</td> <td> <select class="form-select form-select-sm" aria-label="Default select example"> <option value="0" selected></option> <option name="route[]" value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </td> <td> <select class="form-select form-select-sm" aria-label="Default select example"> <option value="0" selected></option> <option name="peserta" value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </td> <td> <input input="hari_jam" type="text" class="form-control form-control-sm" name="hari_jam[]"> </td> <td> <input type="number" class="form-control form-control-sm" name="harga[]"> </td> <td> <input type="number" class="form-control form-control-sm" name="total_harga[]"> </td> <td> <input type="text" class="form-control form-control-sm" name="keterangan[]"> </td> </tr>'
    }

    const vm_input_ddt_db = new Vue({
        el: "#appVue",
        data: {
            components: [Comp]
        },
        methods: {
            add(e) {
                e.preventDefault()
                this.components.push(Comp)
            }
        }
    })

    function views() {
        var val = {};
        val.modal = 'modal';
        val.no_md = event.target.value;
        val.training = "<?= $get_data->training ?>";

        $.post('<?php echo base_url() ?>Program_training/Proses_pengajuan_training_c/detail_peserta/', val, function(data) {
            // alert(data);
            if (JSON.parse(data).status == true) {
                $('#modal_detail_peserta').html(JSON.parse(data).modal);
                $('#tmpl_peserta').modal('show');
            } else {
                alert(JSON.parse(data).msg);
            }
            // window.location.assign('<?php echo base_url() ?>Program_training/Proses_pengajuan_training_c/detail_ppt/?no_md='+val.no_md+'');

        });
    }
</script>