<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="col-12 col-md-7 card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center mb-5">
                            <img src="<?= base_url('assets/img/logo/logo-toko.png'); ?>" alt="Logo Hitam" width="100">
                            <h4 class="text-capitalize pt-4" style="color: #000; font-weight: 500;">barokah amanah catering</h4>
                        </div>
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('auth/registrasi', ['class' => 'user']); ?>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                <?= form_error('nama_lengkap', ' <small class="pl-2 text-danger">', '</small>') ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', ' <small class="pl-2 text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="telp" class="form-control form-control-user" id="no_telp" name="no_telp" placeholder="No Handphone" value="<?= set_value('no_telp'); ?>">
                                <?= form_error('no_telp', ' <small class="pl-2 text-danger">', '</small>') ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                <?= form_error('password', ' <small class="pl-2 text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-hijau btn-user btn-block">
                            Registrasi
                        </button>
                        <?= form_close() ?>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('login'); ?>">Sudah punya akun? Silahkan login</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('home'); ?>">Halaman utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>