<div class="container-fluid">
    <h1 class="h3 text-gray-800 mb-2"><?= $title; ?></h1>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" value="<?= $user['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="tel" class="form-control" id="no_telp" value="<?= $user['no_telp']; ?>" readonly>
                </div>
            </form>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $user['id_user']; ?>">Edit Profile</button>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($user as $data) : ?>
    <div class="modal fade" id="edit<?= $user['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('direktur/edit_profile') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= ucwords($user['nama_lengkap']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= $user['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no telp" value="<?= ucwords($user['no_telp']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>