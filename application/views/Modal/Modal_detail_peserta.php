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
                        <input class="form-check-input" type="radio" name="country" id="btn_country1" required>Dalam Negeri
                    </div>
                    <div class="col-sm-4">
                        <input class="form-check-input" type="radio" name="country" id="btn_country2" required>Luar Negeri
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
                                <td class="p-2"><input type="number" onkeyup="hitung_jumlah(this)" id="uang_saku<?= $row->nip_peserta;?>" value="123" name="uang_saku[]" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input id="uang_saku_check<?= $row->nip_peserta;?>" value="<?= $row->nip_peserta;?>" name=""  type="checkbox" checked=>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="p-2"><input type="number" onkeyup="hitung_jumlah(this)" name="transportasi[]" value="210" id="transportasi<?= $row->nip_peserta;?>" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input id="transportasi_check<?= $row->nip_peserta;?>" type="checkbox" name="" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="p-2"> <input type="number" onkeyup="hitung_jumlah(this)" name="penginapan[]" value="310" id="penginapan<?= $row->nip_peserta;?>" disabled></td>
                                <td class="p-2">
                                    <label class="customcheck">
                                        <input id="penginapan_check<?= $row->nip_peserta;?>" type="checkbox" name="" checked="checked">
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
                            <td><input id="total_uang_saku" class="border-0" type="text" name="total_uang_saku" readonly></td>
                            <td></td>
                            <td><input id="total_transportasi" class="border-0" type="text" name="total_transportasi" readonly></td>
                            <td></td>
                            <td><input id="total_penginapan" class="border-0" type="text" name="total_penginapan" readonly></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="simpan_uang_saku" class="btn btn-warning">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
     $(document).ready(function() {
        total_();

        function total_(){
            sum_uang_saku = 0;
            sum_transportasi = 0;
            sum_penginapan = 0;
            <?php $no = 1; foreach ($data_peserta as $row) : ?>
                uang_saku = $('#uang_saku<?= $row->nip_peserta;?>').val();
                sum_uang_saku += parseInt(uang_saku);
                transportasi = $('#transportasi<?= $row->nip_peserta;?>').val();
                sum_transportasi += parseInt(transportasi);
                penginapan = $('#penginapan<?= $row->nip_peserta;?>').val();
                sum_penginapan += parseInt(penginapan);
                
            <?php endforeach; ?>
            $('#total_uang_saku').val(sum_uang_saku);
            $('#total_transportasi').val(sum_transportasi);
            $('#total_penginapan').val(sum_penginapan);
        }
    });

    function hitung_jumlah(nilai){
        names = $(nilai).attr('name');
        name = names.replace('[]','');
        // term = $("input[type=number][name="+name+"]").val();
        this['sum_'+name] = 0;
        <?php $no = 1; foreach ($data_peserta as $row) : ?>
            val_ = $('#'+name+'<?= $row->nip_peserta;?>').val();
            this['sum_'+name] += parseInt(val_);
            
        <?php endforeach; ?>
        $('#total_'+name).val(this['sum_'+name]);
        // alert(this['sum_'+name]);

    }



    $('#btn_country1').on("click",function() {
        $('#negara').attr('disabled','disabled');
        $('#biaya_makan').attr('disabled','disabled');
    });
    $('#btn_country2').on("click",function() {
        $('#negara').removeAttr('disabled');
        $('#biaya_makan').removeAttr('disabled');
    });

    <?php $no = 1; foreach ($data_peserta as $row) : ?>
    $('input[id="uang_saku_check<?= $row->nip_peserta;?>"]').click(()=>{
        if($('input[id="uang_saku_check<?= $row->nip_peserta;?>"]').prop("checked") == true){
            $('#uang_saku<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#uang_saku<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });

    $('input[id="transportasi_check<?= $row->nip_peserta;?>"]').on("click",()=>{
        if($('input[id="transportasi_check<?= $row->nip_peserta;?>"]').is(":checked")){
            $('#transportasi<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#transportasi<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });

    $('input[id="penginapan_check<?= $row->nip_peserta;?>"]').on("click",()=>{
        if($('input[id="penginapan_check<?= $row->nip_peserta;?>"]').is(":checked")){
            $('#penginapan<?= $row->nip_peserta;?>').attr('disabled', 'disabled');
        }else{
            $('#penginapan<?= $row->nip_peserta;?>').removeAttr('disabled');
        }
    });
    <?php endforeach; ?>

    // $('#total_uang_saku').on('keyup',()=>{
    //     <?php $no = 1; foreach ($data_peserta as $row) : ?>
    //         tes = $('#uang_saku<?= $row->nip_peserta;?>').value;
    //         alert(tes);
    //     <?php endforeach; ?>
    // })


    // $('#simpan_uang_saku').on('click',()=>{
    //     alert('esteh');
    // });

</script>