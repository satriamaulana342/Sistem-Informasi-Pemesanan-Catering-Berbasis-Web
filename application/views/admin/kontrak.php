<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('admin/tambah_paket_menu'); ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">No.</th>
                            <th>Nama Perusahaan</th>
                            <th>Perwakilan</th>
                            <th>Alamat</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Harga Paket</th>
                            <th>Surat Kontrak</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kontrak as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= ucwords($value['nama_perwakilan']); ?></td>
                                <td><?= ucwords($value['alamat']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_awal']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_akhir']); ?></td>
                                <td>Rp <?= number_format($value['harga_paket']); ?>,-</td>

                                <td>
                                    <?php if ($value['status_kontrak'] == 'kontrak') : ?>
                                        <a href="<?= base_url('admin/surat_kontrak/' . $value['id_kontrak']); ?>" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $statusClasses = [
                                        'belum kontrak' => 'badge-secondary',
                                        'habis kontrak' => 'badge-danger',
                                        'kontrak'       => 'badge-success',
                                    ];

                                    $statusClass = isset($statusClasses[$value['status_kontrak']]) ? $statusClasses[$value['status_kontrak']] : '';
                                    ?>
                                    <span class="badge badge-pill <?= $statusClass; ?>">
                                        <?= ucwords($value['status_kontrak']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit_kontrak/' . $value['id_kontrak']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_kontrak']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_kontrak/' . $value['id_kontrak']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/tambah_kontrak'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_user">Nama Perusahaan</label>
                    <select class="form-control" id="id_user" name="id_user" required oninvalid="this.setCustomValidity('Silakan pilih nama perusahaan')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($user as $value) : ?>
                            <option value="<?= $value['id_user']; ?>"><?= ucwords($value['nama_lengkap']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_perwakilan">Nama Perwakilan</label>
                    <input type="text" min="1" class="form-control" id="nama_perwakilan" name="nama_perwakilan" placeholder="Masukkan nama perwakilan" required oninvalid="this.setCustomValidity('Harga paket Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="alamat ini bersifat opsional" require></textarea>
                </div>
                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required oninvalid="this.setCustomValidity('Pilih Tanggal Awal')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required oninvalid="this.setCustomValidity('Pilih Tanggal Akhir')" oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="harga_paket">Harga</label>
                    <input type="number" min="1" class="form-control" id="harga_paket" name="harga_paket" placeholder="Masukkan harga paket" required oninvalid="this.setCustomValidity('Harga paket Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
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
<?php foreach ($kontrak as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_kontrak']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_kontrak/' . $value['id_kontrak']) ?>
                <?= form_hidden('id_kontrak', $value['id_kontrak']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_user">Nama Perusahaan</label>
                        <select class="form-control" id="id_user" name="id_user" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Perusahaan')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($user as $data) : ?>
                                <option value="<?= $data['id_user']; ?>" <?= ($data['id_user'] == $value['id_user']) ? 'selected' : '' ?>><?= ucwords($data['nama_lengkap']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_perwakilan">Nama Perwakilan</label>
                        <input type="text" class="form-control" id="nama_perwakilan" name="nama_perwakilan" value="<?= $value['nama_perwakilan']; ?>" required oninvalid="this.setCustomValidity('Pilih Tanggal Awal')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="alamat ini bersifat opsional" require><?= ucwords($value['alamat']); ?></textarea>
                </div>
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $value['tanggal_awal']; ?>" required oninvalid="this.setCustomValidity('Pilih Tanggal Awal')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $value['tanggal_akhir']; ?>" required oninvalid="this.setCustomValidity('Pilih Tanggal Akhir')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="harga_paket">Harga</label>
                        <input type="number" min="1" class="form-control" id="harga_paket" name="harga_paket" placeholder="Masukkan harga paket" value="<?= $value['harga_paket']; ?>" required oninvalid="this.setCustomValidity('Harga paket Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
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