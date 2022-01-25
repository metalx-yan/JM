<section class="content" style="margin:-40px 0 0 0 ;">
        <div class="row title-content bg-warning m-3 p-2">
            <div class="col-12">
                <h5>List Data Proses Pengajuan Training</h5>
            </div>
        </div>
        <div class="row m-3 pb-3 border-bottom border-warning border-3">
            <div class="col-12">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Status Data Training</label>
                    <div class="col-sm-4">
                        <select id="status_data" name="status_data" class="form-select" aria-label="Default select example">
                            <option value="0" selected>Open this select Status</option>
                            <?php foreach($status_data as $status):?>
                                <option value="<?= $status->id_status_data?>"><?= $status->status_data?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button id="cari" class="btn btn-warning">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <strong class="border-bottom border-2 border-dark">Pengajuan Budget Training</strong>
            </div>
        </div>
        <div class="table-content m-3">
            <table id="proses_pengajuan_training" class="table table-bordered align-middle">
                <thead>
                    <tr class="text-center bg-info">
                        <th scope="row">No</th>
                        <th> No. MD</th>
                        <th>Perihal</th>
                        <th>Dari</th>
                        <th>Tgl MD</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Durasi</th>
                        <th>Kelompok Training</th>
                        <th>SLA</th>
                        <th>Approve Detail Budget</th>
                        <th>Act</th>
                    </tr>
                    <!-- <?php
                        for ($i=1; $i < 5; $i++) { 
                        $no=0;
                        $no+=$i;
                    ?>    
                    <tr>
                        <td><?= $no?></td>
                        <td><a href="<?= base_url('Program_training/Proses_pengajuan_training_c/detail_ppt')?>">937/RMDN-HC/18</a> </td>
                        <td>Permohonan Persetujuan Pelaksanaan Sosialisasi</td>
                        <td>Human Capital Regional Medan</td>
                        <td class="text-center">15-Nov-18</td>
                        <td class="text-center">29-Nov-18</td>
                        <td class="text-center">30-Nov-18</td>
                        <td>2 Hari</td>
                        <td>In House</td>
                        <td>X</td>
                        <td>Approve</td>
                        <td><button class="btn btn-success">Edit</button></td>
                    </tr>
                    <?php }
                    ?>
                    </tr> -->
                </thead>
            </table>
        </div>
    </section>

   <script>
    //    function status(){
    //             statusData = $('select[name=status_data] option').filter(':selected').val()
    //             // alert(statusData);
    //             default_dt(statusData);
    //         }
        $(document).ready(function() {
            
            // function default_dt(statusData) {
                var table = $('#proses_pengajuan_training').DataTable({
                    // "dom": '<"top"i>rt<"bottom"><"clear">', //MENGHILANGKAN SEARCH
                    "processing": true,
                    "responsive":true,
                    "serverSide": true,
                    "ordering": false, // Set true agar bisa di sorting
                    "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                    "ajax":
                    {
                        "url": "<?= base_url('Program_Training/Proses_pengajuan_training_c/view_data_query/');?>", // URL file untuk proses select datanya
                        "type": "POST"
                        // "data" : {"datas":statusData}
                    },
                    "deferRender": true,
                    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
                    "columns": [
                        {"data": 'nomor_pengajuan',"sortable": false, // !!! id_sort
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                        },
                        { "data": "nomor_pengajuan" },
                        { "data": "perihal" },
                        { "data": "unit_kerja" },
                        { "data": "tgl_pengajuan" },
                        { "data": "tgl_pelaksanaan_awal" },
                        { "data": "tgl_pelaksanaan_akhir" },
                        { "data": "durasi" },
                        { "data": "jenis_training" },
                        { "data": "jenis_training" },
                        { "data": "realisasi_biaya_decision" },
                        {data: null,
                            render: function (data, type, row, meta) {
                                return '<button class="btn btn-primary" value="'+data.nomor_pengajuan+'" onclick="views()" >View</button></a>';
                            }
                        } 
                    ],
                });

                $('#cari').on('keyup click',()=>{
                statusData = $('select[name=status_data] option').filter(':selected').val();
                table.search(statusData).draw();
            })
            // }
        });

        

        function views(){
            var val = {};
            // val.modal = 'modal';
            val.no_md = event.target.value;
            // alert(val.main_id);
            $.get('<?php echo base_url()?>Program_training/Proses_pengajuan_training_c/detail_ppt/',val,function(data){ 
            // alert(data);
            // if (JSON.parse(data).status == true) {
            //     $('.modals').html(JSON.parse(data).modal);
            //     $('#Detail_ListMD').modal('show');
            // }else{
            //     alert(JSON.parse(data).msg);
            // }
            window.location.assign('<?php echo base_url()?>Program_training/Proses_pengajuan_training_c/detail_ppt/?no_md='+val.no_md+'');
            
            });
        }

       
   </script>