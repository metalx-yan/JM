<section class="level_user">
    <div class="row">
        <div class="col-md-12">
            <div class="card ms-5 me-5">
                <div class="card-header bg-warning">
                    Maintain User Level
                </div>
                <!-- <div class="card-body"> -->
                    <!-- <div class="table-content m-3"> -->
                        <table class="table table-bordered table-striped align-middle">
                            <tbody>
                                <tr class="text-center">
                                    <th scope="row">No</th>
                                    <th>Level User</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                    $no=1;
                                    foreach($level_user as $row){
                                ?>    
                                <tr class="text-center">
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['level_user']; ?></td>
                                    <td>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal_<?= $row['level_user'];?>">Edit</button>
                                        <?= ($row['id'] == 2) ? '': '<button class="btn btn-danger">Delete</button>';?>
                                        
                                    </td>
                                </tr>
                                <?php }
                                ?>

                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                <!-- </div> -->
                <!-- <div class="card-footer text-muted">
                    2 days ago
                </div> -->
            </div>
        </div>
    </div>
</section>


        <!-- Modal Edit-->
        <?php foreach($level_user as $row):?>
        <div class="modal fade" id="exampleModal_<?= $row['level_user'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <form action="<?= base_url('Setting_parameter/Level_user_c/update_level_user')?>" method="post">
            <input type="hidden" name="id_level" value="<?= $row['id']?>">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Update Level User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Level user :</h5>
                        </div>
                        <div class="col-md-10">
                            <h5><?= $row['level_user']?></h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped align-middle">
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Menu Name</th>
                                <th>VIEW</th>
                                <th>ADD</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                            
                                <tr class="text-center">
                                    <th class="text-start">Parent Menu</th>
                                    <th colspan="4"></th>
                                </tr>
                                    
                                <?php foreach($level_detail2 as $row3):?>
                                <?php if($row3['id_level'] == $row['id']):?>
                                    <tr class="text-center">
                                        
                                        <td  class="text-start"><?= $row3['menu_name']?></td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="tampil[]" value="<?= $row['id'].'-'.$row3['id_menu'].'-'.'1'?>" id="flexCheckDefault" 
                                            <?= ($row3['id_level'] == $row['id'] && $row3['tampil'] == 1) ? 'checked': '';?>
                                        >view
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="addm[]" value="<?= $row['id'].'-'.$row3['id_menu'].'-'.'1'?>" id="flexCheckChecked" 
                                            <?= ($row3['id_level'] == $row['id'] && $row3['addm'] == 1) ? 'checked': '';?>
                                            >Add
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="edit[]" value="<?= $row['id'].'-'.$row3['id_menu'].'-'.'1'?>" value="" id="flexCheckChecked" 
                                            <?= ($row3['id_level'] == $row['id'] && $row3['edit'] == 1) ? 'checked': '';?>
                                            >Edit
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="del[]" value="<?= $row['id'].'-'.$row3['id_menu'].'-'.'1'?>" value="" id="flexCheckChecked"
                                            <?= ($row3['id_level'] == $row['id'] && $row3['del'] == 1) ? 'checked': '';?>
                                            >Delete
                                        </td>
                                    </tr>
                                <?php endif;?>
                                <?php endforeach;?>

                            <?php
                                foreach($level_detail3 as $row4){ 
                            ?>    
                                <?php foreach($row4 as $row5){?>
                                <tr class="text-center">
                                    <th class="text-start"><?= $row5['menu_name'] ?></th>
                                    <th colspan="4"></th>
                                </tr>
                                
                                    
                                <?php foreach($level_detail4 as $row6):?>
                                    <?php foreach($row6 as $row7):?>
                                    <?php if($row7['parent'] ==  $row5['id_menu'] && $row7['id_level'] == $row['id']):?>
                                        <tr class="text-center">
                                            <td  class="text-start"><?= $row7['menu_name']?></td>
                                            <td> 
                                                <input class="form-check-input" type="checkbox" name="tampil[]" value="<?= $row['id'].'-'.$row7['id_menu'].'-'.'1'?>" id="flexCheckDefault" 
                                                <?= ($row7['id_level'] == $row['id'] && $row7['tampil'] == 1) ? 'checked': '';?>
                                                >view
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="addm[]" value="<?= $row['id'].'-'.$row7['id_menu'].'-'.'1'?>" value="1" id="flexCheckChecked" 
                                                <?= ($row7['id_level'] == $row['id'] && $row7['addm'] == 1) ? 'checked': '';?>
                                                >Add
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="edit[]" value="<?= $row['id'].'-'.$row7['id_menu'].'-'.'1'?>" value="1" id="flexCheckChecked" 
                                                <?= ($row7['id_level'] == $row['id'] && $row7['edit'] == 1) ? 'checked': '';?>
                                                >Edit
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="del[]" value="<?= $row['id'].'-'.$row7['id_menu'].'-'.'1'?>" value="1" id="flexCheckChecked"
                                                <?= ($row7['id_level'] == $row['id'] && $row7['del'] == 1) ? 'checked': '';?>
                                                >Delete
                                            </td>
                                        </tr>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                                <?php }?>
                            <?php }?>

                           
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
                                    
        </div>
        </div>
        <?php endforeach;?>