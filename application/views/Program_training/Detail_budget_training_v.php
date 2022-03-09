<section class="content" style="margin:-40px 0 0 0 ;">
    <div class="row title-content bg-warning m-3 p-2">
        <div class="col-12">
            <h5>List Data Detail Training dan Detail Budget</h5>
        </div>
    </div>
   
    <div class="table-content m-3">
        <table id="proses_pengajuan_training" class="table text-center table-bordered align-middle">
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
                    <th>Budget</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<=6;$i++){?>
                <tr>
                    <td><?= $i ?></td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>tes</td>
                    <td>
                        <button value="312" onclick="views()"  class="btn btn-primary">view</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    // $(document).ready(function() {
    //     $('#loader').hide();
    //     statusData = '';
    //     default_dt(statusData);

    //     function default_dt(statusData) {
    //         var table = $('#proses_pengajuan_training').DataTable({
    //             language: {
    //                 searchPlaceholder: "No. MD"
    //             },
    //             "destroy": true,
    //             "searching": true,
    //             "processing": true,
    //             "responsive": true,
    //             "serverSide": true,
    //             "ordering": false, // Set true agar bisa di sorting
    //             "order": [
    //                 [0, 'asc']
    //             ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
    //             "ajax": {
    //                 "url": "<?= base_url('Program_Training/Proses_pengajuan_training_c/view_data_query/'); ?>", // URL file untuk proses select datanya
    //                 "type": "POST",
    //                 "data": {
    //                     'status_non': statusData
    //                 }
    //             },
    //             "deferRender": true,
    //             "aLengthMenu": [
    //                 [5, 10, 50],
    //                 [5, 10, 50]
    //             ], // Combobox Limit
    //             "columns": [{
    //                     "data": 'nomor_pengajuan',
    //                     "sortable": false, // !!! id_sort
    //                     render: function(data, type, row, meta) {
    //                         return meta.row + meta.settings._iDisplayStart + 1;
    //                     }
    //                 },
    //                 {
    //                     "data": "nomor_pengajuan"
    //                 },
    //                 {
    //                     "data": "perihal"
    //                 },
    //                 {
    //                     "data": "unit_kerja"
    //                 },
    //                 {
    //                     "data": "tgl_pengajuan"
    //                 },
    //                 {
    //                     "data": "tgl_pelaksanaan_awal"
    //                 },
    //                 {
    //                     "data": "tgl_pelaksanaan_akhir"
    //                 },
    //                 {
    //                     "data": "durasi"
    //                 },
    //                 {
    //                     "data": "jenis_training"
    //                 },
    //                 {
    //                     "data": "jenis_training"
    //                 },
    //                 {
    //                     "data": "realisasi_biaya_decision",
    //                     "data": "status_non_memo",
    //                     render: function(data, type, row, meta) {
    //                         return (row.realisasi_biaya_decision == '' && row.status_non_memo == '1' || row.realisasi_biaya_decision === null && row.status_non_memo == '1') ? 'Proses Pengajuan' : row.realisasi_biaya_decision;
    //                     }
    //                 },
    //                 {
    //                     data: null,
    //                     render: function(data, type, row, meta) {
    //                         return '<button class="btn btn-primary" value="' + data.nomor_pengajuan + '" onclick="views()" >View</button></a>';
    //                     }
    //                 }
    //             ],
    //             "oLanguage": {
    //                 sProcessing: "<img src='<?= base_url() ?>Assets/images/loading_mega.gif' width='100px'>"
    //             },
    //         });
    //     }

    //     $("#cari").on('click', function() {
    //         statusData = $('select[name=status_data] option').filter(':selected').val();
    //         default_dt(statusData);
    //         // alert(statusData);
    //     });
    // });




    function views() {
        var val = {};
        val.modal = 'modal';
        val.no_md = event.target.value;
        alert(val.no_md);
        // $.get('<?php echo base_url() ?>Program_training/Detail_budget_training_c/detail_ppt/', val, function(data) {
        //     if (JSON.parse(data).status == true) {
        //         $('.modals').html(JSON.parse(data).modal);
        //         $('#Detail_ListMD').modal('show');
        //     }else{
        //         alert(JSON.parse(data).msg);
        //     }
            window.location.assign('<?php echo base_url() ?>Program_training/Detail_budget_training_c/detail_ppt/?no_md=' + val.no_md + '');

        // });
    }

</script>