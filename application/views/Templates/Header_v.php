<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRMS | <?= $title_head ?></title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="<?= base_url('Assets/bootstrap-5/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('Assets/bootstrap-icons/font/bootstrap-icons.css')?>">
    <!-- link sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url('Assets/sweetalert2/dist/sweetalert2.min.css')?>">
    <script src="<?= base_url('Assets/sweetalert2/dist/sweetalert2.min.js')?>"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('Assets/DataTables/datatables.min.css')?>">
    <script src="<?= base_url('Assets/jquery/dist/jquery.min.js')?>"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
    <script src="<?= base_url('Assets/DataTables/datatables.min.js')?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

    <style>
.customcheck {
  position: relative;
}

.customcheck input {
  display: none;
}

.customcheck input~.checkmark {
  background: #ee0b0b;
  width: 25px;
  display: inline-block;
  position: relative;
  height: 25px;
  border-radius: 2px;
  vertical-align:middle;
  margin-right:10px;
}

.customcheck input~.checkmark:after,
.customcheck input~.checkmark:before {
  content: '';
  position: absolute;
  width: 2px;
  height: 16px;
  background: #fff;
  left: 12px;
  top: 4px;
}

.customcheck input~.checkmark:after {
  transform: rotate(-45deg);
  z-index: 1;
}

.customcheck input~.checkmark:before {
  transform: rotate(45deg);
  z-index: 1;
}

.customcheck input:checked~.checkmark {
  background: #3d8a00;
  width: 25px;
  display: inline-block;
  position: relative;
  height: 25px;
  border-radius: 2px;
}

.customcheck input:checked~.checkmark:after {
  display: none;
}

.customcheck input:checked~.checkmark:before {
  background: none;
  border: 2px solid #fff;
  width: 6px;
  top: 2px;
  left: 9px;
  border-top: 0;
  border-left: 0;
  height: 13px;
  top: 2px;
}   
    </style>

</head>
<body>
        <?php echo $this->session->flashdata('msg');?>
     	<?php
            if(isset($_SESSION['msg'])){
                unset($_SESSION['msg']);
            }
        ?>
    
<!-- Header -->
    <section class="header-top">
        <!-- <div class="row" style="width:100%"> -->
            <!-- <div class="col-xl-12 col-sm-12 col-md-12" > -->
                <img width="100%" src="<?= base_url('Assets/images/header.jpg')?>" alt="logo">
                <div style="margin: -70px 0 0 0;">
                    <div class="text-center" style="font-size:2.5vw;">Training Resource Management System</div>
                    <!-- <div class="text-left bg-danger"> -->
                    <?php if($title_head !== 'Login'):?>
                    <span style="text-align:right;line-height:20px;">
                    <?php 
                        $session_name = $_SESSION['username'];
                        $time = date('D, d-m-Y');
                    ?>
                        <p style="margin: -50px 20px 0 0;">Welcome, <?= $session_name?> - KPNO</p>
                        <p style="margin: 0 20px 0 0;"><?= $time ?></p>
                        <a href="<?= base_url('Login_c/logout')?>"><p style="margin: 0 20px 0 0;"><img width="20px" src="<?= base_url('Assets/images/log_off.png')?>" alt="logout"></p></a>
                    </span>
                    <?php endif;?>
                    <!-- </div> -->
                </div>
            <!-- </div>
        </div> -->
    </section>
