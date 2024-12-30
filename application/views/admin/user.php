<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="10%">No.</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Role</th>
                            <!-- <th width="15%">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= ucwords($value['no_telp']); ?></td>
                                <td><?= ucwords($value['role']); ?></td>
                                <!-- <td>
                                    <a href="<?= base_url('admin/edit_user/' . $value['id_user']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_user']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_user/' . $value['id_user']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/tambah_user'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no telp" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($user as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_user/' . $value['id_user']) ?>
                <?= form_hidden('id_user', $value['id_user']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= ucwords($value['nama_lengkap']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= ucwords($value['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no telp" value="<?= ucwords($value['no_telp']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
                    </div>
                    <div class="form-group">
                        <label for="id_role">Role</label>
                        <select class="form-control" id="id_role" name="id_role" required>
                            <?php foreach ($role as $data) : ?>
                                <option value="<?= $data['id_role']; ?>" <?= ($data['id_role'] == $value['id_role']) ? 'selected' : '' ?>><?= ucwords($data['role']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>