<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                </div>
                                <?= form_open('process_reset_password/' . $token, ['class' => 'user']); ?>
                                <input type="hidden" name="email" value="<?= $email; ?>">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password Baru" required>
                                </div>
                                <button type="submit" class="btn btn-hijau btn-user btn-block">
                                    Reset Password
                                </button>
                                <?= form_close() ?>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('registrasi'); ?>">Tidak punya akun? Silahkan registrasi</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('home'); ?>">Halaman Utama</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>