<section>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h5>Fasilitas Biaya Training</h5>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_fasilitas">Add Fasilitas</button>
            </div>

            <div class="tab mt-3">
            <table id="fasilitas_biaya_training" class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Fasilitas</th>
                        <th>Kode Lokasi</th>
                        <th>Kode Cabang Peserta</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            </div>
            
        </div>
    </div>
</section>


<!-- Modal Add -->
<div class="modal fade" id="add_fasilitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    <form action="<?= base_url('Setting_parameter/fasilitas_biaya_training_c/save_data')?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD FASILITAS BIAYA TRAINING</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Fasilitas</label>
                    <div class="col-sm-7">
                    <input type="text" name="kode_fasilitas" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Lokasi</label>
                    <div class="col-sm-7">
                    <input type="text"  name="kode_lokasi" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Kode Cabang Peserta</label>
                    <div class="col-sm-7">
                    <input type="text" name="kode_cabang_peserta" class="form-control">
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
<!-- Tutup Modal Add -->

<!-- Modal Edit -->
<div class="modal_edit_fbt">

</div>

<!-- Modal Edit -->

<script>
    $(document).ready(()=> {
        // data_table();

        // function data_table(){
            $('#fasilitas_biaya_training').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": false, // Set true agar bisa di sorting
                "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('Setting_parameter/fasilitas_biaya_training_c/view_data_query/');?>", // URL file untuk proses select datanya
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
                "columns": [
                    {"data": 'kode_fasilitas',"sortable": false, // !!! id_sort
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                    },
                    { "data": "kode_fasilitas" },
                    { "data": "kode_lokasi" },
                    { "data": "kode_cabang_peserta" },
                    {data: null,
                        render: function (data, type, row, meta) {
                            return '<button class="btn btn-success" onclick="edit_modal()" value="'+data.kode_fasilitas+'-'+data.kode_lokasi+'-'+data.kode_cabang_peserta+'" >Edit</button> <button class="btn btn-danger" value="'+data.kode_fasilitas+'" >Delete</button>';
                        }
                    } 
                ],
            });
        // }

    });

    function edit_modal(){
        var val = {};
        val.modal = 'modal';
        val.value = event.target.value;
        val.arry = val.value.split('-');
        
        // alert(arry);


        $.post('<?php echo base_url()?>Setting_parameter/fasilitas_biaya_training_c/modal_edit/',val,function(data){ 
            $(".modal_edit_fbt").html(data);
            $('#edit_fbt').modal('show');
            // if (JSON.parse(data).status == true) {
            //     $('#modal_detail_peserta').html(JSON.parse(data).modal);
            //     $('#tmpl_peserta').modal('show');
            // }else{
            //     alert(JSON.parse(data).msg);
            // }
            // window.location.assign('<?php echo base_url()?>Program_training/Proses_pengajuan_training_c/detail_ppt/?no_md='+val.no_md+'');
            
            });
    }
</script>