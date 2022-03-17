<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="form_<?= $id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?= $modal_title ?></h5>
        <button type="button" data="<?= $id?>" onclick="close_modal(this)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3 row">
          <div class="col-sm-7 form-group">
            <input type="hidden" id="input-id_job" onkeyup="key(this)" value="<?php echo (($id_job) ? $id_job->id : '') ?>" name="id" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
            <input type="hidden" id="input-id_position" onkeyup="key(this)" value="<?php echo (($position) ? $position->position_id : '') ?>" name="position_id" class="form-control" required <?php echo (($id == 'modal_edit' || $id == 'modal_delete') ? 'readonly' : '') ?>>
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="user_name" value="<?= $username_login ?>">
            <input type="hidden" name="form_" value="send">
            <div id="error"></div>
          </div>
        </div>

        <div class="modal-body">
        <div class="row">
          <div class="col-md-6">

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Name</label>
            <div class="col-sm-7 form-group">
              <input list="encodings" type="text" id="input-job_name" onkeyup="key(this)" value="<?php echo (($id_job) ? $id_job->id_job : '') ?>" name="job_name" class="form-control" required <?php echo (($id == 'modal_delete') ? 'disabled' : '') ?>>
                <datalist id="encodings">
                    <?php foreach($job as $job):?>
                        <option value="<?= $job['id_job']?>"><?= $job['job_title']; ?></option>
                    <?php endforeach; ?>
                </datalist>
              <span id="error"></span>
            </div>
          </div>
          
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Functional Group</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="function_group" id="input-function_group" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
            <option value="<?= (( $id_job)? $id_job->func_group_id : '' )?>" selected><?php echo (( $id_job)? $id_job->func_group_id : '' ) ?></option>
                <?php foreach($functional_group as $funcgroup):?>
                    <option value="<?= $funcgroup['func_group_id']?>"><?= $funcgroup['func_group_id']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Function</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_function" id="input-job_function" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
                <option value="<?= (( $id_job)? $id_job->id_job_function : '' )?>" selected><?php echo (( $id_job)? $id_job->job_function : '' ) ?></option>
                <?php foreach($job_function as $jobfunction):?>
                    <option value="<?= $jobfunction['id_job_function']?>"><?= $jobfunction['job_function']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Sub Function</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_sub_function" id="input-job_sub_function" class="form-select form-select-sm job_sub_function" aria-label=".form-select-sm example">
            <option value="<?= (( $id_job)? $id_job->id_job_sub_function : '' )?>" selected><?php echo (( $id_job)? $id_job->job_sub_function : '' ) ?></option>

            
          </select>
            <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Family</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_family" id="input-job_family" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
                <option value="<?= (( $id_job)? $id_job->id_job_family : '' )?>" selected><?php echo (( $id_job)? $id_job->job_family : '' ) ?></option>
                <?php foreach($job_family as $jobfamily):?>
                    <option value="<?= $jobfamily['id_job_family']?>"><?= $jobfamily['job_family']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Sub Family</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_sub_family" id="input-job_sub_family" class="form-select form-select-sm job_sub_family" aria-label=".form-select-sm example">
              <option value="<?= (( $id_job)? $id_job->id_job_sub_family : '' )?>" selected><?php echo (( $id_job)? $id_job->job_sub_family : '' ) ?></option>
            </select>
            <span id="error"></span>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Job Discipline</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="job_discipline" id="input-job_discipline" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
                <option value="<?= (( $id_job)? $id_job->Discipline_Code.'-'.$id_job->Discipline_Description : '' )?>" selected><?php echo (( $id_job)? $id_job->Discipline_Description : '' ) ?></option>
                <?php foreach($job_discipline as $jobdiscipline):?>
                    <option value="<?= $jobdiscipline['Discipline_Code'] . '-' . $jobdiscipline['Discipline_Description']?>"><?= $jobdiscipline['Discipline_Description']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div> 

          </div>

          <div class="col-md-6">
            <div class="mb-3 row">
              <label class="col-sm-5 col-form-label">Purpose</label>
              <div class="col-sm-7 form-group">
              <textarea name="purpose" cols="30" rows="4" class="form-control" style="resize: none;"></textarea>
              <span id="error"></span>
              </div>
            </div>

            <div class="mb-3 row">
            <label class="col-sm-5 col-form-label">Career Band</label>
            <div class="col-sm-7 form-group">
            <select onchange="check_v(this)" name="career_band" id="input-career_band" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo (( $id == 'modal_delete')? 'disabled' : '' ) ?> required>
                <option value="<?= (( $id_job)? $id_job->id_job_level: '' )?>" selected><?php echo (( $id_job)? $id_job->Grade_Name : '' ) ?></option>
                <?php foreach($career_band as $carrerband):?>
                    <option value="<?= $carrerband['id_job_level']?>"><?= $carrerband['Grade_Name']; ?></option>
                <?php endforeach; ?>
            </select>
              <span id="error"></span>
            </div>
          </div> 
          </div>

        </div>
        </div>
        <div class="modal-footer">
          <button type="button" data="<?= $id ?>" onclick="action_submit(this)" class="btn btn-primary">Send to Admin</button>
        </div>
      </form>
    </div>
  </div>
</div>