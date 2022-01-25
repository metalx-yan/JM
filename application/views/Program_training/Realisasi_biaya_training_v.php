<section class="content" style="margin:-40px 0 0 0 ;">
        <div class="row title-content bg-warning m-3 p-2">
            <div class="col-12">
                <h5>List Data <?= $title_head?></h5>
            </div>
        </div>
        <div class="row m-3 pb-3 border-bottom border-warning border-3">
            <div class="col-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Status Data Training</label>
                    <div class="col-sm-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-warning">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <strong class="border-bottom border-2 border-dark">Data <?= $title_head?></strong>
            </div>
        </div>
        <div class="table-content m-3">
            <table class="table table-bordered align-middle">
                <tbody>
                    <tr class="text-center bg-info">
                        <th scope="row">No</th>
                        <th> No. MD</th>
                        <th>Perihal</th>
                        <th>Dari</th>
                        <th>Tgl MD</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th class="bg-danger">Budget</th>
                        <th class="bg-danger">Realisasi</th>
                        <th class="bg-danger">Selisih</th>
                    </tr>
                    <?php
                        for ($i=1; $i < 5; $i++) { 
                        $no=0;
                        $no+=$i;
                    ?>    
                    <tr>
                        <td><?= $no?></td>
                        <td><a href="<?= base_url('Program_training/Realisasi_biaya_training_c/detail_app_realisasi')?>">937/RMDN-HC/18</a> </td>
                        <td>Permohonan Persetujuan Pelaksanaan Sosialisasi</td>
                        <td>Human Capital Regional Medan</td>
                        <td class="text-center">15-Nov-18</td>
                        <td class="text-center">29-Nov-18</td>
                        <td class="text-center">30-Nov-18</td>
                        <td>Rp.xxxxx</td>
                        <td>Rp.xxxxx</td>
                        <td>xx %</td>
                    </tr>
                    <?php }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

   

   