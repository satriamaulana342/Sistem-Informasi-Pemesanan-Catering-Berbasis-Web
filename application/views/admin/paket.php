<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('admin/tambah_paket'); ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
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
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Minimal Pemesanan</th>
                            <th>Paket Kategori</th>
                            <th>Foto</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paket as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_paket']); ?></td>
                                <td>Rp <?= number_format($value['harga']); ?></td>
                                <td><?= $value['minimal_pemesanan']; ?> Box</td>
                                <td><?= ucwords($value['nama_kategori']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#foto<?= $value['id_paket']; ?>">
                                        <i class="fas fa-image"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit_paket/' . $value['id_paket']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_paket']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_paket/' . $value['id_paket']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
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
            <?= form_open_multipart('admin/tambah_paket') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_paket">Nama Paket</label>
                    <input type="text" class="form-control" id="nama_paket" name="nama_paket" placeholder="Masukkan nama paket" required oninvalid="this.setCustomValidity('Nama Paket Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" min="1" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" required oninvalid="this.setCustomValidity('Harga Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="minimal_pemesanan">Minimal Pemesanan</label>
                    <input type="number" min="10" class="form-control" id="minimal_pemesanan" name="minimal_pemesanan" placeholder="Masukkan minimal pemesanan" required oninvalid="this.setCustomValidity('Minimal Pemesanan Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="id_paket_kategori">Kategori</label>
                    <select class="form-control" id="id_paket_kategori" name="id_paket_kategori" required oninvalid="this.setCustomValidity('Silakan Pilih Kategori')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($paket_kategori as $value) : ?>
                            <option value="<?= $value['id_paket_kategori']; ?>"><?= ucwords($value['nama_kategori']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control-file" id="foto" name="foto" required oninvalid="this.setCustomValidity('Silakan Masukkan Foto')" oninput="this.setCustomValidity('')">
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
<?php foreach ($paket as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_paket']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('admin/edit_paket/' . $value['id_paket']) ?>
                <?= form_hidden('id_paket', $value['id_paket']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket" name="nama_paket" placeholder="Masukkan nama paket" value="<?= ucwords($value['nama_paket']); ?>" required oninvalid="this.setCustomValidity('Nama Paket Tidak Boleh kosong')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" min="1" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" value="<?= $value['harga']; ?>" required oninvalid="this.setCustomValidity('Harga Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="minimal_pemesanan">Minimal Pemesanan</label>
                        <input type="number" min="1" class="form-control" id="minimal_pemesanan" name="minimal_pemesanan" placeholder="Masukkan minima pemesanan" value="<?= $value['minimal_pemesanan']; ?>" required oninvalid="this.setCustomValidity('Minimal Pemesanan Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="id_paket_kategori">Kategori</label>
                        <select class="form-control" id="id_paket_kategori" name="id_paket_kategori" required oninvalid="this.setCustomValidity('Silakan Pilih Kategori')" oninput="this.setCustomValidity('')">
                            <?php foreach ($paket_kategori as $kat) : ?>
                                <option value="<?= $kat['id_paket_kategori']; ?>" <?= ($kat['id_paket_kategori'] == $value['id_paket_kategori']) ? 'selected' : '' ?>><?= ucwords($kat['nama_kategori']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                        <small class="form-text text-muted">*Biarkan kosong jika tidak ingin mengubah foto.</small>
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

<!-- MODAL FOTO -->
<?php foreach ($paket as $value) : ?>
    <div class="modal fade" id="foto<?= $value['id_paket']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= ucwords($value['nama_paket']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/img/upload_paket/' . $value['foto']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>