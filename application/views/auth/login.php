<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-5">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center mb-5">
                                    <img src="<?= base_url('assets/img/logo/logo-toko.png'); ?>" alt="Logo Hitam" width="100">
                                    <h4 class="text-capitalize pt-4" style="color: #000; font-weight: 500;">barokah amanah catering</h4>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <?= form_open('auth', ['class' => 'user']); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', ' <small class="pl-2 text-danger">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    <?= form_error('password', ' <small class="pl-2 text-danger">', '</small>') ?>
                                </div>
                                <button type="submit" class="btn btn-hijau btn-user btn-block">
                                    Login
                                </button>
                                <?= form_close() ?>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('registrasi'); ?>">Tidak punya akun? Silahkan registrasi</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('lupa_password'); ?>">Lupa Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
