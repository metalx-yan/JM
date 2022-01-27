
<section class="navbar">
        <div class="row m-3 border-bottom border-dark border-5" style="width:100%;">
        <?php if($title_head == 'Login'):?>
            <div class="col-md-6">
                <a href="<?= base_url("Home_c")?>"><span class="float-start"><img src="<?= base_url('Assets/images/homemenu.png')?>" alt="home"></span></a>
            </div>
            <div class="col-md-6">
                <a href="<?= base_url("Login_c")?>"><p style="float:right">Login</p></a>
            </div>
        <?php ;else:?>
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a href="<?= base_url('Home_c')?>"><span class="float-start"><img src="<?= base_url('Assets/images/homemenu.png')?>" alt="home"></span></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <?php foreach($navbar_parent as $navbar_parent):?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $navbar_parent['menu_name']?>
                                </a>
                                <ul class="animate-menu slideIn-menu dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <?php foreach($navbar_child as $child){?>
                                        <?php if($child['parent'] == $navbar_parent['id_menu']):?>
                                            <li><a class="dropdown-item" href="<?= base_url($child['file'])?>"><?= $child['menu_name']?></a></li>
                                        <?php endif; ?>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php endforeach;?>
                        </div>
                        </div>
                    </div>
                </nav>
            </div>
        <?php endif;?>
        </div>
    </section>