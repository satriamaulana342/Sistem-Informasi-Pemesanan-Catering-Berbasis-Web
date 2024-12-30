<div class="container-fluid">
    <h1 class="h3 text-gray-800 mb-2"><?= $title; ?></h1>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">Kode Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Status Pengiriman</th>
                            <th>Surat Jalan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= ucwords($value['kode_pesanan']); ?></td>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_pemesanan']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_pengiriman']); ?></td>
                                <td>
                                    <?php
                                    $statusClasses = [
                                        'pending'   => 'badge-danger',
                                        'proses'    => 'badge-warning',
                                        'dikirim'   => 'badge-success',
                                        'selesai'   => 'badge-primary'
                                    ];

                                    $statusClass = isset($statusClasses[$value['status_pengiriman']]) ? $statusClasses[$value['status_pengiriman']] : '';
                                    ?>
                                    <span class="badge badge-pill <?= $statusClass; ?>">
                                        <?= ucwords($value['status_pengiriman']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($value['status_pengiriman'] == 'dikirim' || $value['status_pengiriman'] == 'selesai') : ?>
                                        <a href="<?= base_url('admin/surat_jalan_perusahaan/' . $value['id_pesanan_perusahaan']); ?>" class="btn btn-sm btn-primary" target="_blank">
                                            Cetak Surat
                                        </a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_pesanan_perusahaan']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/detail_transaksi_perusahaan/' . $value['id_pesanan_perusahaan']); ?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i>
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

<!-- MODAL EDIT -->
<?php foreach ($pesanan as $key => $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_pesanan_perusahaan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_transaksi_perusahaan/' . $value['id_pesanan_perusahaan']) ?>
                <?= form_hidden('id_pesanan_perusahaan', $value['id_pesanan_perusahaan']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status_pengiriman">Status Pengiriman</label>
                        <select id="status_pengiriman" name="status_pengiriman" class="form-control status_pengiriman" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="pending" <?= $value['status_pengiriman'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="proses" <?= $value['status_pengiriman'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                            <option value="dikirim" <?= $value['status_pengiriman'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                            <option value="selesai" <?= $value['status_pengiriman'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
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