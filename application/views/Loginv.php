
<section class="content-body">
    <div class="row">   
        <div class="col-md-12">
            <div class="box-center mx-auto" style="width:35%">
                <div class="card">
                    <div class="card-header bg-warning">
                        Login Form
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url("Login_c/do_login")?>">
                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" placeholder="NIP" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Masuk</button>
                        </form>
                        <br>
                        <p><a href="#">Register</a> / <a href="">Lupa Password</a></p>
                    </div>
                    <!-- <div class="card-footer text-muted">

                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

    