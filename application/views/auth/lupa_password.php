<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-5">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <?= form_open('reset_password', ['class' => 'user']); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" required>
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