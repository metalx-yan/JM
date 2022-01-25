

<!-- modal Detail -->
    <div class="modal fade" id="Detail_ListMD" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalToggleLabel">List Data Pengajuan Training</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <strong>MD Pengajuan Training</strong> 
                        </div>
                    </div>

                    <div class="row mt-2 align-middle">
                        <div class="col-md-5">
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">No. MD</label>
                                <div class="col-sm-7">
                                <input type="text" id="no_md" class="form-control" value="<?= $datas->nomor_pengajuan?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Perihal</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->perihal?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Dari</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control"  value="<?= $datas->nip_pengaju?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Tanggal MD</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->tgl_pengajuan?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Kelompok Training</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->jenis_training?>" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-1"></div>
                        
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Hari / Tanggal</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->tgl_pelaksanaan_awal?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Waktu</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="Belum Tau" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Tempat</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="Belum Join" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Alamat</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->alamat_training?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Fasilator</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->fasilitator?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-5 col-form-label">Jml Peserta</label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" value="<?= $datas->jml_peserta?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ms-3">
                        <strong>PIC HCMG</strong>   
                    </div>
                </div>
                
                <div class="row ms-1 align-items-start">
                    <div class="col-md-12">
                        <div class="mb-3 row">
                            <label class="col-sm-2 text-start col-form-label">Staff HCMG</label>
                            <div class="col-sm-4">
                                <select class="form-select" id="staff_hcmg" aria-label="Default select example">
                                    <option value="0" selected>Select this Staff HCMG</option>
                                    <?php foreach($staff as $row) :?>
                                        <option value="<?= $row->user_name?>"><?= $row->nama?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-warning" id="save_staff_hcmg" onclick="simpan_staff()">Simpan</button>
                                <button class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>