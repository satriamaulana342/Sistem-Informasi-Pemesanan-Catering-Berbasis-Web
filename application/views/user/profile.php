<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">profile</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 50px 0px;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-semibold">Profile Pelanggan</h6>
                        <hr>
                        <form action="">
                            <fieldset disabled>
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" placeholder="Nama Lengkap" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No Telp</label>
                                    <input type="tel" class="form-control" id="no_telp" name="no_telp" value="<?= $user['no_telp']; ?>" placeholder="No Telp">
                                </div>
                            </fieldset>
                            <button type="button" class="btn btn-hijau" data-bs-toggle="modal" data-bs-target="#edit<?= $user['id_user']; ?>">
                                Edit Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL EDIT PROFILE -->
<?php foreach ($user as $u) : ?>
    <div class="modal fade" id="edit<?= $user['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('user/edit_profile') ?>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" placeholder="Masukkan email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="tel" class="form-control" id="no_telp" name="no_telp" value="<?= $user['no_telp']; ?>" placeholder="Masukkan no telp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-hijau">Konfirmasi</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>