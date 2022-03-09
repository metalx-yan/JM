<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="mb-3 row">
                <label class="col-sm-5 col-form-label">Nama Posisi : </label>
                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                        <b><?= $posisi->position_name?></b>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-5 col-form-label">Job : </label>
                <div class="col-sm-7 form-group">
                    
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample" style="height: 300px;overflow-x: hidden;overflow-y: auto;">
                    <?php foreach($id_job as $list):?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-Corporate Funding Head">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= str_replace(' ','',$list['job_title']) ?>" aria-expanded="false" aria-controls="flush-<?= str_replace(' ','',$list['job_title']) ?>">
                                <?=  $list['job_title'] ?>
                            </button>
                            </h2>
                            <div id="flush-<?= str_replace(' ','',$list['job_title']) ?>" class="accordion-collapse collapse" aria-labelledby="flush-Corporate Funding Head" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Name : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['job_title'] ?></b>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Functional Group : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <!-- <b><?=  $list['job_title'] ?></b> -->
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Function : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['job_function'] ?></b>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Sub Function : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['job_sub_function'] ?></b>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Family : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['job_family'] ?></b>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Sub Family : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['job_sub_family'] ?></b>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Job Discipline : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                        <b><?=  $list['Discipline_Description'] ?></b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Purpose : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                    <textarea name="purpose" id="" style="rezise:none;" disabled cols="30" rows="4" class="form-control"><?=  $list['purpose'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-5 col-form-label">Career Band : </label>
                                                <div class="col-sm-7 form-group d-flex align-content-around flex-wrap">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                        
                    </div>
            </div>
       
      </form>
    </div>
  </div>
</div>