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
                            <th>Metode</th>
                            <th>Opsi</th>
                            <th>Status Pengiriman</th>
                            <th>Status Pembayaran</th>
                            <th>Tgl Transfer DP Awal</th>
                            <th>Tgl Transfer DP Akhir</th>
                            <th>Tgl Transfer Lunas</th>
                            <th width="10%">Surat Jalan</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= ucwords($value['kode_pesanan']); ?></td>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= ucwords($value['metode_pembayaran']); ?></td>
                                <td><?= ucwords($value['opsi_pembayaran']); ?></td>
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
                                    <?php
                                    $statusClasses = [
                                        'belum diterima'    => 'badge-warning',
                                        'ditolak'           => 'badge-danger',
                                        'diterima'          => 'badge-success',
                                        'dibatalkan'        => 'badge-secondary',
                                    ];

                                    $statusClass = isset($statusClasses[$value['status_pembayaran']]) ? $statusClasses[$value['status_pembayaran']] : '';
                                    ?>
                                    <span class="badge badge-pill <?= $statusClass; ?>">
                                        <?= ucwords($value['status_pembayaran']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?= isset($value['tgl_transfer_dp_awal']) && $value['tgl_transfer_dp_awal'] != null 
                                    ? date('d-m-Y', strtotime($value['tgl_transfer_dp_awal'])) : '-'; 
                                                     ?>
                                </td>                                <td>
                                    <?= isset($value['tgl_transfer_dp_akhir']) && $value['tgl_transfer_dp_akhir'] != null 
                                    ? date('d-m-Y', strtotime($value['tgl_transfer_dp_akhir'])) : '-'; 
                                                     ?>
                                </td>
                                <td>
                                    <?= isset($value['tgl_transfer_lunas']) && $value['tgl_transfer_lunas'] != null 
                                    ? date('d-m-Y', strtotime($value['tgl_transfer_lunas'])) : '-'; 
                                                     ?>
                                </td>
                                <td>
                                    <?php if ($value['status_pengiriman'] == 'dikirim' || $value['status_pengiriman'] == 'selesai') : ?>
                                        <a href="<?= base_url('admin/surat_jalan/' . $value['kode_pesanan']); ?>" class="btn btn-sm btn-primary" target="_blank">
                                            Cetak Surat
                                        </a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($value['status_pembayaran'] != 'dibatalkan') : ?>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['kode_pesanan']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/detail_transaksi/' . $value['kode_pesanan']); ?>" class="btn btn-sm btn-secondary">
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
    <div class="modal fade" id="edit<?= $value['kode_pesanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_transaksi/' . $value['kode_pesanan']) ?>
                <?= form_hidden('kode_pesanan', $value['kode_pesanan']) ?>
                <?= form_hidden('metode_pembayaran', $value['metode_pembayaran']) ?>
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
                    <div class="form-group">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <select id="status_pembayaran" name="status_pembayaran" class="form-control status_pembayaran" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="belum diterima" <?= $value['status_pembayaran'] == 'belum diterima' ? 'selected' : '' ?>>Belum Diterima</option>
                            <option value="diterima" <?= $value['status_pembayaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                            <?php if ($value['metode_pembayaran'] == 'transfer') : ?>
                                <option value="ditolak" <?= $value['status_pembayaran'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group keteranganDitolak" style="display: none;">
                        <label for="keterangan_ditolak">Keterangan Ditolak</label>
                        <textarea class="form-control keterangan_ditolak" id="keterangan_ditolak" name="keterangan_ditolak" rows="3" placeholder="Masukkan keterangan ditolak"></textarea>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusPembayaran = document.querySelectorAll('.status_pembayaran');
        var keteranganDitolak = document.querySelectorAll('.keteranganDitolak');
        var keterangan_ditolak = document.querySelectorAll('.keterangan_ditolak');

        statusPembayaran.forEach(function(statusPembayaran, index) {
            statusPembayaran.addEventListener('change', function() {
                if (this.value === 'ditolak') {
                    keteranganDitolak[index].style.display = 'block';
                    keterangan_ditolak[index].setAttribute('required', 'required');
                } else {
                    keteranganDitolak[index].style.display = 'none';
                    keterangan_ditolak[index].removeAttribute('required');
                    keterangan_ditolak[index].value = '';
                }
            });
        });
    });
</script>