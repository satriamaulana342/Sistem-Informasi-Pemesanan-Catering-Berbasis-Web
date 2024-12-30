<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>

    <?= $this->session->flashdata('pesan'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="10%">No.</th>
                            <th>Nama Paket Kategori</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paket_kategori as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_kategori']); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit_paket_kategori/' . $value['id_paket_kategori']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_paket_kategori']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_paket_kategori/' . $value['id_paket_kategori']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
                                </td>
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
            <?= form_open('admin/tambah_paket_kategori'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_kategori">Nama Paket Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama paket kategori" required oninvalid="this.setCustomValidity('Silakan Masukkan Nama Paket Kategori')" oninput="this.setCustomValidity('')">
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
<?php foreach ($paket_kategori as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_paket_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_paket_kategori/' . $value['id_paket_kategori']) ?>
                <?= form_hidden('id_paket_kategori', $value['id_paket_kategori']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Paket kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama paket kategori" value="<?= ucwords($value['nama_kategori']); ?>" required>
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