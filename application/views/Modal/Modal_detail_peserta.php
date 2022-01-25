<!-- Modal Tampilkan -->
<div class="modal fade" id="tmpl_peserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        <div class="row text-center">
            <div class="col-md-12">
               <strong> Daftar Peserta Training</strong>
            </div>
            <div class="col-md-12">
                <strong>(Nama Program Training)</strong>
            </div>
        </div>
        <div class="row text-end mt-5">
            <div class="col-md-5">
                <div class="row mb-3">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-4 ms-4">
                        <input class="form-check-input" type="radio" name="country" id="btn_country1">Dalam Negeri
                    </div>
                    <div class="col-sm-4">
                        <input class="form-check-input" type="radio" name="country" id="btn_country2">Luar Negeri
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 text-start">
                        Negara/Wilayah</div>
                    <div class="col-sm-8">
                        <select id="negara" class="form-select form-select-sm" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 text-start">
                        Biaya Makan</div>
                    <div class="col-sm-8">
                        <select id="biaya_makan" class="form-select form-select-sm" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 " style="overflow:auto;">
                <table class="table-responsive table-bordered text-center align-middle" width="100%" style="font-size: 12px;">
                    <thead>
                        <tr class="">
                            <th class="bg-info">No</th>
                            <th class="bg-info">NIP</th>
                            <th class="bg-info">Nama Peserta</th>
                            <th class="bg-info">Jabatan</th>
                            <th class="bg-info">Direktorat</th>
                            <th class="bg-info">Pangkat/Golongan</th>
                            <th class="bg-info">Lokasi Cabang</th>
                            <?php if ($training == 'OFFLINE') { ?>
                                <th class="bg-danger">Uang Saku</th>
                                <th class="bg-danger">Act</th>
                                <th class="bg-danger">Transportasi</th>
                                <th class="bg-danger">Act</th>
                                <th class="bg-danger">Penginapan</th>
                                <th class="bg-danger">Act</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data_peserta as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->nip_peserta; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->job_title; ?></td>
                            <td><?= $row->branch_name; ?></td>
                            <td><?= $row->pangkat; ?></td>
                            <td><?= count($data_peserta)?></td>
                            <?php if ($training == 'OFFLINE') { ?>
                                <td class="p-2"><input type="text" id="uang_saku<?= $row->nip_peserta;?>" value="120" name="uang_saku" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input name="uang_saku_check<?= $row->nip_peserta;?>" value="<?= $row->nip_peserta;?>" id="uang_saku"  type="checkbox" checked=>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="p-2"><input type="text" name="transportasi" value="210" id="transportasi<?= $row->nip_peserta;?>" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input name="transportasi_check<?= $row->nip_peserta;?>" type="checkbox" id="" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="p-2"> <input type="text" name="penginapan" value="310" id="penginapan<?= $row->nip_peserta;?>" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input name="penginapan_check<?= $row->nip_peserta;?>" type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php if ($training == 'OFFLINE') { ?>
                    <tfoot>
                        <tr>
                            <th class="text-end" colspan="7">Jumlah</th>
                            <td class="bg-danger">xxxxxxxx</td>
                            <td class="bg-danger"></td>
                            <td class="bg-danger">xxxxxxxx</td>
                            <td class="bg-danger"></td>
                            <td class="bg-danger">xxxxxxxx</td>
                            <td class="bg-danger"></td>
                        </tr>
                    </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#btn_country1').on("click",function() {
        $('#negara').attr('disabled','disabled');
        $('#biaya_makan').attr('disabled','disabled');
    });
    $('#btn_country2').on("click",function() {
        $('#negara').removeAttr('disabled');
        $('#biaya_makan').removeAttr('disabled');
    });

    <?php $no = 1; foreach ($data_peserta as $row) : ?>
    $('input[name="uang_saku_check<?= $row->nip_peserta;?>"]').click(()=>{
        if($('input[name="uang_saku_check<?= $row->nip_peserta;?>"]').prop("checked") == true){
            $('#uang_saku<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#uang_saku<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });

    $('input[name="transportasi_check<?= $row->nip_peserta;?>"]').on("click",()=>{
        if($('input[name="transportasi_check<?= $row->nip_peserta;?>"]').is(":checked")){
            $('#transportasi<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#transportasi<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });

    $('input[name="penginapan_check<?= $row->nip_peserta;?>"]').on("click",()=>{
        if($('input[name="penginapan_check<?= $row->nip_peserta;?>"]').is(":checked")){
            $('#penginapan<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#penginapan<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });
    <?php endforeach; ?>

</script>