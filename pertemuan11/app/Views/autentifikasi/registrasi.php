<?php
    helper('form');
    $session = \Config\Services::session();
    $validation = \Config\Services::validation();
?>
<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Menjadi Member!</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('autentifikasi/registrasi'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?= set_value("nama"); ?>" id="nama" placeholder="Nama Lengkap" name="nama">
                                    <?= $validation->showError('nama'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?= set_value("email"); ?>" id="email" placeholder="Alamat Email" name="email">
                                    <?= $validation->showError('email'); ?>
                                </div>
                                <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                                    <?= $validation->showError('password1'); ?>
                                    <input type="password" class="form-control form-control-user" id="password2" placeholder="Ulangi Password" name="password2">
                                    <?= $validation->showError('password2'); ?>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftar Menjadi Member
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('autentifikasi/lupaPassword'); ?>">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                              Sudah Menjadi Member?
                                <a class="small" href="<?= base_url('autentifikasi'); ?>">Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>