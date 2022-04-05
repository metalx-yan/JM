<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.row {
    padding: 0px !important;
    margin: 0px !important; 
}

.row > div {
    margin: 0px !important;
    padding: 0px !important;
}
</style>
    <link rel="stylesheet" href="<?= base_url('Assets/bootstrap-5/css/bootstrap.min.css')?>">
    <!-- link sweetalert2 -->


    <script src="<?= base_url('Assets/jquery/dist/jquery.min.js')?>"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

    <script src="<?= base_url('Assets/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js');?>"></script>

</head>
<body>

<table width="100%">
    <tr>
    <td>
        <th align="left">
            <a href="#default"  class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/a/af/Bank_Mega_2013.svg" alt="" height="8%" width="12%"></a>
        </th>
        <th align="right"> <h3><strong>JOB MANAGEMENT SYSTEM</strong></h3></th>
    </td>
    </tr>
</table>

<hr>
<div style="padding-left:20px">
  <div style="font-weight:bold;font-size:16px">1. Profile Jabatan</div>
  <!-- <hr> -->
    <table width="100%">
        <tr>
            <td>
                <th>&nbsp;&nbsp;&nbsp;</th>
            </td>
        </tr>
        <tr>
            <td>
                <th align="left">
                    <div style="font-weight:bold;">Nama Posisi :</div>
                    <div style="font-weight:normal;"><?= $data_profile->position_name ?></div>
                </th>
                <th align="center"> 
                    <div style="font-weight:bold;">Job Function :</div>
                    <div style="font-weight:normal;"><?= $data_profile->job_function ?></div>
                </th>
            </td>
        </tr>
        <tr>
            <td>
                <th>&nbsp;&nbsp;&nbsp;</th>
            </td>
        </tr>
        <tr>
            <td>
                <th align="left">
                    <div style="font-weight:bold;">Nama Job :</div>
                    <div style="font-weight:normal;"><?= $data_profile->job_title ?></div>
                </th>
                <th align="center"> 
                    <div style="font-weight:bold;">Job Family :</div>
                    <div style="font-weight:normal;"><?= $data_profile->job_family ?></div>
                </th>
            </td>
        </tr>
    </table>

    <div style="font-weight:bold;font-size:16px;margin-top:40px">2. Tugas & Tanggung Jawab</div>
   <div style="margin-top:10px">
    <ul >
        <?php foreach($tanggung_jawab as $tugas):?>
            <li><?= $tugas['description'] ?></li>
        <?php endforeach; ?>
    </ul>
   </div>

   <div style="font-weight:bold;font-size:16px;margin-top:20px">3. Kewenangan</div>
   <div style="margin-top:10px">
    <ul >
        <?php foreach($kewenangan as $kewenangan):?>
                <li><?= $kewenangan['kewenangan'] ?></li>
        <?php endforeach; ?>
    </ul>
   </div>

   <div style="font-weight:bold;font-size:16px;margin-top:20px">4. Kualifikasi Jabatan</div>
   <div style="margin-top:10px">
        <p style="text-indent: 20px;font-weight:bold;">Pendidikan</p>
        <ul>
            <?php foreach($pengalaman_kerja as $kerja):?>
            <li><?= $kerja['description'] ?></li>
            <?php endforeach; ?>
        </ul>
        <p style="text-indent: 20px;font-weight:bold;">Kompetensi yang dibutuhkan</p>

        <ul>
            <?php foreach($kompetensi as $kompetensi):?>
            <li><?= $kompetensi['kompetensi'] ?></li>
            <?php endforeach; ?>
    </ul>
   </div>
</div>
</body>
</html>
