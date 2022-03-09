<section class="manage_menu">
    <div class="row w-100">
        <div class="col-md-12">
            <div class=" ms-5 me-5">
                <div class="card-header bg-warning mb-3">
                    <div class="row">
                        <div class="col-6">
                            <h5>Maintain Menu</h5>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-sm btn-primary" id="add" data-bs-toggle="modal" data-bs-target="#modal_addMenu"> ADD MENU</button>
                        </div>
                    </div>
                </div>

                <table id="manage_menu" class="table table-bordered table-striped  text-center align-middle">
                    <thead>
                        <tr class="text-center">
                            <!-- <th scope="row">No</th> -->
                            <th>Menu Name</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- modal EDIT-->
<?php
    $no=1;
    foreach($list_menu as $row){
?>    
<div class="modal fade" id="exampleModal_<?= $row['id_menu'];?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="hesas">
                <h5 class="modal-title" id="exampleModalToggleLabel">Add Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- content -->
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Manu Name</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Type</label>
                    <div class="col-sm-7">
                    <select id="type_menu" class="form-select type_menu" aria-label="Default select example">
                        <option selected>Open this select Type menu</option>
                        <option value="Parent">Parent</option>
                        <option value="Child">Child</option>
                        <option value="Child2">Child 2</option>
                        <option value="Child3">Child 3</option>
                    </select>
                    </div>
                </div>

                <div class="mb-3 row parent_menu" id="parent_menu">
                </div>

                <div class="mb-3 row file_name_" id="file_name_">
                    <label class="col-sm-5 col-form-label">File Name</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Is Menu</label>
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label">Position</label>
                    <div class="col-sm-7">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <!-- close content -->
            </div>
        </div>
    </div>
</div>
<?php } ?>



<script>
    $(document).ready(function() {
        
         first_load();
         default_dt();

        function first_load(){
            $('.file_name_').hide();
        }

        
        function default_dt() {
            $('#manage_menu').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('Setting_parameter/Manage_menu_c/list_menu/');?>", // URL file untuk proses select datanya
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
                "columns": [
                    { "data": "menu_name" },
                    { "data": "type" },
                    {data: null,
                        render: function (data, type, row, meta) {
                            return '<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal_'+data.id_menu+'" value="'+data.id_menu+'">Edit</button> <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete'+data.id_menu+'" value="'+data.id_menu+'">Delete</button>';
                        }
                    } 
                ],
            });
        }

    });

    $('.type_menu').change(function(){ 
        var value = $(this).val();
        var val = {};
        val.type = value;
        
        if (value == 'Child' || value == 'Child2' || value == 'Child3') {
            $.post('<?php echo base_url()?>Setting_parameter/Manage_menu_c/parent_menu',val,function(data){ 
                $('.file_name_').show();
                $('.parent_menu').html(data);
            });
        }else if(value == 'Parent'){
            $('.file_name_').show();
        }
        else{
            $('.file_name_').hide();
        }
    });
</script>