<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('admin/tambah_item'); ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
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
                            <th>Nama Menu</th>
                            <th>Nama Item</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td><?= ucwords($value['nama_item']); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit_item/' . $value['id_item']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_item']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_item/' . $value['id_item']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
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
            <?= form_open('admin/tambah_item'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_menu">Nama Menu</label>
                    <select class="form-control" id="id_menu" name="id_menu" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Menu')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($menu as $value) : ?>
                            <option value="<?= $value['id_menu']; ?>"><?= ucwords($value['nama_menu']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_item">Nama Item</label>
                    <input type="text" class="form-control" id="nama_item" name="nama_item" placeholder="Masukkan nama item" required oninvalid="this.setCustomValidity('Silakan Masukkan Nama Item')" oninput="this.setCustomValidity('')">
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
<?php foreach ($item as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_item']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_item/' . $value['id_item']) ?>
                <?= form_hidden('id_item', $value['id_item']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_menu">Nama Menu</label>
                        <select class="form-control" id="id_menu" name="id_menu" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Menu')" oninput="this.setCustomValidity('')">
                        <option value="">Pilih</option>
                            <?php foreach ($menu as $data) : ?>
                                <option value="<?= $data['id_menu']; ?>" <?= ($data['id_menu'] == $value['id_menu']) ? 'selected' : '' ?>><?= ucwords($data['nama_menu']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_item">Nama Item</label>
                        <input type="text" class="form-control" id="nama_item" name="nama_item" placeholder="Masukkan nama item" value="<?= ucwords($value['nama_item']); ?>" required oninvalid="this.setCustomValidity('Silakan Masukkan Nama Item')" oninput="this.setCustomValidity('')">
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