<section class="content" style="margin:-40px 0 0 0 ;">
        <div class="row title-content bg-warning m-3 p-2">
            <div class="col-12">
                <h5>List Data Pengajuan Training</h5>
            </div>
        </div>
        <div class="table-content m-3">
            <table id="example" class="table display table-bordered align-middle" >
                <thead class="text-center tb-md">
                    <tr >
                        <!-- <th scope="row">No</th> -->
                        <th>No. MD</th>
                        <th>Perihal</th>
                        <th>Dari</th>
                        <th>Tgl MD</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Durasi</th>
                        <th>Kelompok Training</th>
                        <th>Jenis Training</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </section>

    <div class="modals">

    </div>

    <script>
    $(document).ready(function() {
        default_dt();
        function default_dt() {
            $('#example').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": false, // Set true agar bisa di sorting
                "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('Program_Training/MD_pengajuan_training_c/view_data_query/');?>", // URL file untuk proses select datanya
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
                "columns": [
                    { "data": "nomor_pengajuan" },
                    { "data": "perihal" },
                    { "data": "nip_pengaju" },
                    { "data": "tgl_pengajuan" },
                    { "data": "tgl_pelaksanaan_awal" },
                    { "data": "tgl_pelaksanaan_akhir" },
                    { "data": "durasi" },
                    { "data": "jenis_training" },
                    { "data": "training" },
                    {data: null,
                        render: function (data, type, row, meta) {
                            return '<button class="btn btn-primary" value="'+data.nomor_pengajuan+'" onclick="views()" >View</button>';
                        }
                    } 
                ],
            });
        }
    });

    function views(){
        var val = {};
        val.modal = 'modal';
        val.no_md = event.target.value;
        // alert(val.main_id);
        $.post('<?php echo base_url()?>Program_Training/MD_pengajuan_training_c/view_data_query/',val,function(data){ 
            // alert(data);
            if (JSON.parse(data).status == true) {
                $('.modals').html(JSON.parse(data).modal);
                $('#Detail_ListMD').modal('show');
            }else{
                alert(JSON.parse(data).msg);
            }
            
        });
    }

    function simpan_staff(){
        var val = {};
        val.action = 'save';
        val.no_md = $('#no_md').val();
        val.staff_hcmg = $('#staff_hcmg').val();

        if(val.staff_hcmg == 0){
            alert('staff hcmg harus diisi');
        }else{
            // alert('ok ke to save');
            $.post('<?php echo base_url()?>Program_Training/MD_pengajuan_training_c/view_data_query/',val,function(data){ 
                // alert(data->msg);
                if (data.status == false) {
                    alert(data.msg);
                }else{
                    alert(data.msg);
                    // $('button[id="save_staff_hcmg"]').attr("data-bs-dismiss", "modal");
                    $('#Detail_ListMD').modal('hide');
                }
            });

        }
        
    }

    


    </script>
   