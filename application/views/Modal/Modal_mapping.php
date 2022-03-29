<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="delegate" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3 row">
          <div class="col-sm-7 form-group">
            <div id="error"></div>
          </div>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Job</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Position</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $job_position->id_job ?></td>
                        <td><?= $job_position->job_title ?></td>
                        <td><?= $job_position->position_name ?></td>
                    </tr>
                </tbody>
            </table>
            <form id="form_mapping">
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Mapping to</label>
                        <div class="col-sm-7 form-group">
                            <input type="hidden" id="job_val" value="<?= $job ?>" name="job">
                            <input type="hidden" id="mapping_to" value="<?= $mapping_to ?>" name="mapping_to">
                            <input type="hidden" id="position_name" value="<?= $job_position->position_name ?>" name="position_name">
                            <input type="hidden" id="job_title" value="<?= $job_position->job_title ?>" name="job_title">
                            <select onchange="check_v(this)" name="mapping" id="input-mapping" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?> required>
                                    <option value="<?= (($id_job) ? $id_job->user_name : '') ?>" selected><?php echo (($id_job) ? $id_job->singkatan . ' - ' . strtoupper($id_job->nama) . ' - ' . $id_job->job_title  : '') ?></option>
                                    <?php foreach ($user_onjob as $uon) : ?>
                                <?php foreach ($people as $name) : ?>
                                        <?php if ($uon['user_name'] == $name['user_name']) { ?>
                                            <option value="" disabled style="background-color:#c7c5c5; "><?=  strtoupper($name['nama']) ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $name['nama'] .'-'.$name['user_name'] ?>"><?=  strtoupper($name['nama']) ?></option>
                                        <?php }  ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        <span id="error"></span>
                        </div>
                </div>
                <button type="button" onclick="render()" class="btn btn-primary btn-sm float-end">Save</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Position</th>
                            <th scope="col">Job Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="nama_value"></td>
                            <td id="position_value"></td>
                            <td id="job_value"></td>
                        </tr>
                    </tbody>
                </table>                        
                <button type="button" data="mapping" onclick="action_submit(this)" class="btn btn-primary btn-sm float-end btn-mapping" disabled>Send to Employee</button>

            </form>
        </div>
    </div>
  </div>
</div>