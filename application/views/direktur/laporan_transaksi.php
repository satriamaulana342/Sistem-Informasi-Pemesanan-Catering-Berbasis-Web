<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <?= form_open() ?>
        <div style="display: flex; align-items: flex-end; gap: 8px;">
            <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
            </div>
            <div class="form-group">
                <button type="submit" formaction="<?= base_url('direktur/print_laporan_excel') ?>" formtarget="_blank" class="btn btn-success text-white">Excel</button>
                <button type="submit" formaction="<?= base_url('direktur/print_laporan_pdf') ?>" formtarget="_blank" class="btn btn-danger text-white">PDF</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Nama Pelanggan</th>
                            <th>Bukti Lunas</th>
                            <th>Bukti DP Awal</th>
                            <th>Bukti DP Akhir</th>
                            <th>Status Transaksi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td>
                                    <?php if (!empty($value['bukti_transfer_lunas'])) : ?>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalBuktiTransfer<?= $value['id_transaksi']; ?>">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php else : ?>
                                        <span class='text-muted'>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($value['bukti_transfer_dp_awal'])) : ?>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalBuktiDpAwal<?= $value['id_transaksi']; ?>">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php else : ?>
                                        <span class='text-muted'>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($value['bukti_transfer_dp_akhir'])) : ?>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalBuktiDpAkhir<?= $value['id_transaksi']; ?>">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php else : ?>
                                        <span class='text-muted'>-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= ucwords($value['status_pengiriman']); ?></td>
                                <td>Rp <?= number_format($value['total']); ?>,-</td>
                            </tr>

                            <!-- MODAL BUKTI TRANSFER LUNAS -->
                            <?php if (!empty($value['bukti_transfer_lunas'])) : ?>
                                <div class="modal fade" id="modalBuktiTransfer<?= $value['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiTransferLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalBuktiTransferLabel<?= $value['id_transaksi']; ?>">Bukti Transfer Lunas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= base_url('assets/img/bukti_transfer/lunas/' . $value['bukti_transfer_lunas']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- MODAL BUKTI TRANSFER DP AWAL -->
                            <?php if (!empty($value['bukti_transfer_dp_awal'])) : ?>
                                <div class="modal fade" id="modalBuktiDpAwal<?= $value['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAwalLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalBuktiDpAwalLabel<?= $value['id_transaksi']; ?>">Bukti Transfer DP Awal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= base_url('assets/img/bukti_transfer/dp_awal/' . $value['bukti_transfer_dp_awal']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- MODAL BUKTI TRANSFER DP AKHIR -->
                            <?php if (!empty($value['bukti_transfer_dp_akhir'])) : ?>
                                <div class="modal fade" id="modalBuktiDpAkhir<?= $value['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAkhirLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalBuktiDpAkhirLabel<?= $value['id_transaksi']; ?>">Bukti Transfer DP Akhir</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= base_url('assets/img/bukti_transfer/dp_akhir/' . $value['bukti_transfer_dp_akhir']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>