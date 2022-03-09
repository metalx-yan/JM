<!-- untuk user HCMG Training -->
<section class="content" style="margin:-40px 0 0 0 ;">
  <div class="row title-content bg-warning m-3 p-2">
    <div class="col-12">
      <h5>List Data Training</h5>
    </div>
  </div>
  <div class="row m-3 pb-3 border-bottom border-warning border-3">
    <div class="col-12">
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">No MD</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="no_md" placeholder="Nomor MD">
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Tanggal MD</label>
        <div class="col-sm-1">
          <input type="date" class="form-control" name="start_date">
        </div>
        <!-- <div class="col-sm-1">S/D</div> -->
        S/D
        <div class="col-sm-1">
          <input type="date" class="form-control" name="end_date">
        </div>

      </div>

      <div class="row">
        <label class="col-sm-3 col-form-label">Nama Training</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="nama_training" placeholder="Nama Training">
        </div>
        <div class="col-sm-2">
          <button id="cari" class="btn btn-warning">Cari</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row w-100">
    <div class="col-md-12 text-center">
      <strong class="border-bottom border-2 border-dark">List Data Training</strong>
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
          <th>Kehadiran</th>
          <th>Evaluasi</th>
          <th>Status</th>
          <th>Act</th>
        </tr>
      </thead>
    </table>
  </div>
</section>