<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 text-gray-800 mb-2"><?= $title; ?></h1>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="15%">Kode Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Status Pengiriman</th>
                            <th>Status Pembayaran</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pembatalan_pesanan as $key => $value) : ?>
                            <?php if ($value['status_pembayaran'] === 'dibatalkan') : ?>
                                <tr align="center">
                                    <td><?= ucwords($value['kode_pesanan']); ?></td>
                                    <td><?= ucwords($value['nama_lengkap']); ?></td>
                                    <td>
                                        <?php
                                        $statusClasses = [
                                            'pending'   => 'badge-danger',
                                            'proses'    => 'badge-warning',
                                            'dikirim'   => 'badge-success'
                                        ];

                                        $statusClass = isset($statusClasses[$value['status_pengiriman']]) ? $statusClasses[$value['status_pengiriman']] : '';
                                        ?>
                                        <span class="badge badge-pill <?= $statusClass; ?>">
                                            <?= ucwords($value['status_pengiriman']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-secondary">
                                            <?= ucwords($value['status_pembayaran']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail<?= ucwords($value['id_pembatalan_pesanan']); ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="<?= base_url('admin/pesanan/transaksi_pembatalan/' . $value['id_pembatalan_pesanan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL -->
<?php foreach ($pembatalan_pesanan as $key => $value) : ?>
    <div class="modal fade" id="detail<?= ucwords($value['id_pembatalan_pesanan']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <fieldset disabled>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_user">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?= ucwords($value['nama_lengkap']); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $formatted_date = date('Y-m-d', strtotime($value['tanggal_pemesanan']));
                                    ?>
                                    <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?= $formatted_date; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                                    <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" value="<?= $value['tanggal_pengiriman']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kota_tujuan">Kota Tujuan</label>
                                    <input type="text" class="form-control" id="kota_tujuan" name="kota_tujuan" value="<?= ucwords($value['kota_tujuan']); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= ucwords($value['kecamatan']); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="metode_pembayaran">Metode Pembayaran</label>
                                    <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?= ucwords($value['metode_pembayaran']); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="opsi_pembayaran">Opsi Pembayaran</label>
                                    <input type="text" class="form-control" id="opsi_pembayaran" name="opsi_pembayaran" value="<?= ucwords($value['opsi_pembayaran']); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status_pembayaran">Status Pembayaran</label>
                                    <select id="status_pembayaran" name="status_pembayaran" class="form-control" required>
                                        <option selected disabled value="">Pilih</option>
                                        <option value="tidak diterima" <?= $value['status_pembayaran'] == 'tidak diterima' ? 'selected' : '' ?>>Tidak Diterima</option>
                                        <option value="diterima" <?= $value['status_pembayaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                        <option value="dibatalkan" <?= $value['status_pembayaran'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="status_pengiriman">Status Pengiriman</label>
                                    <select id="status_pengiriman" name="status_pengiriman" class="form-control" required>
                                        <option selected disabled value="">Pilih</option>
                                        <option value="pending" <?= $value['status_pengiriman'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="proses" <?= $value['status_pengiriman'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                                        <option value="dikirim" <?= $value['status_pengiriman'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="total">Total</label>
                                    <input type="text" class="form-control" id="total" name="total" value="Rp <?= number_format($value['total']); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= ucwords($value['alamat']); ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= ucwords($value['keterangan']); ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>