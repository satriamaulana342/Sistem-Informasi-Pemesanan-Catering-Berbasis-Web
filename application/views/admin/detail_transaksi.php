<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="fw-semibold">Rincian Pemesanan</h5>
            <hr>
            <form>
                    <div class="row">
                        <div class="col-2 text-capitalize">
                            <p>kode pesanan</p>
                            <p>nama pelanggan</p>
                            <p>tanggal pemesanan</p>
                            <p>tanggal pengiriman</p>
                            <p>waktu pengiriman</p>
                            <p>kota tujuan</p>
                            <p>kecamatan</p>
                            <p>alamat</p>
                            <p>metode pembayaran</p>
                            <p>opsi pembayaran</p>
                            <p>total</p>
                            <p>status pembayaran</p>
                            <p>status pengiriman</p>
                            <p>keterangan</p>
                        </div>
                        <div class="col-10">
                            
                            <p>: <?= strtoupper($pesanan['kode_pesanan']); ?></p>
                            <p>: <?= ucwords($pesanan['nama_lengkap']); ?></p>
                            <p>: <?= tanggalIndonesia($pesanan['tanggal_pemesanan']); ?></p>
                            <p>: <?= tanggalIndonesia($pesanan['tanggal_pengiriman']); ?></p>
                            <p>: <?= date('H:i', strtotime($pesanan['waktu_pengiriman'])); ?> WIB</p>
                            <p>: <?= ucwords($pesanan['kota_tujuan']); ?></p>
                            <p>: <?= ucwords($pesanan['kecamatan']); ?></p>
                            <p>: <?= ucwords($pesanan['alamat']); ?></p>
                            <p>: <?= ucwords($pesanan['metode_pembayaran']); ?></p>
                            <p>: <?= ucwords($pesanan['opsi_pembayaran']); ?></p>
                            <p>: Rp <?= number_format($pesanan['total']); ?>,-</p>
                            <p>: <?= ucwords($pesanan['status_pembayaran']); ?></p>
                            <p>: <?= ucwords($pesanan['status_pengiriman']); ?></p>
                            <p>: <?= ucwords($pesanan['keterangan']); ?></p>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="fw-semibold">Rincian Transaksi</h5>
            <hr>
            <form>
                <?php foreach ($transaksi as $value) : ?>
                    <div class="row">
                        <div class="col-3 text-capitalize">
                            <p>tanggal transfer lunas</p>
                            <p>bukti transfer lunas</p>
                            <p>tanggal transfer DP awal</p>
                            <p>bukti transfer DP awal</p>
                            <p>tanggal transfer DP akhir</p>
                            <p>bukti transfer DP akhir</p>
                        </div>
                        <div class="col-9">
                            <p>: <?= !empty($value['tgl_transfer_lunas']) ? tanggalIndonesia($value['tgl_transfer_lunas']) : '-'; ?></p>
                            <p>:
                                <?php if (!empty($value['bukti_transfer_lunas'])) : ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_lunas<?= $value['kode_pesanan']; ?>" title="Lihat">
                                        Lihat
                                    </button>
                                    <a href="<?= base_url('assets/img/bukti_transfer/lunas/' . $value['bukti_transfer_lunas']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                        Download
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </p>
                            <p>: <?= !empty($value['tgl_transfer_dp_awal']) ? tanggalIndonesia($value['tgl_transfer_dp_awal']) : '-'; ?></p>
                            <p>:
                                <?php if (!empty($value['bukti_transfer_dp_awal'])) : ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_dp_awal<?= $value['kode_pesanan']; ?>" title="Lihat">
                                        Lihat
                                    </button>
                                    <a href="<?= base_url('assets/img/bukti_transfer/dp_awal/' . $value['bukti_transfer_dp_awal']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                        Download
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </p>
                            <p>: <?= !empty($value['tgl_transfer_dp_akhir']) ? tanggalIndonesia($value['tgl_transfer_dp_akhir']) : '-'; ?></p>
                            <p>:
                                <?php if (!empty($value['bukti_transfer_dp_akhir'])) : ?>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_dp_akhir<?= $value['kode_pesanan']; ?>" title="Lihat">
                                        Lihat
                                    </button>
                                    <a href="<?= base_url('assets/img/bukti_transfer/dp_akhir/' . $value['bukti_transfer_dp_akhir']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                        Download
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="fw-semibold">Detail Pesanan</h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">No.</th>
                            <th width="15%">Nama Paket</th>
                            <th>Komposisi</th>
                            <th>Item Custom</th>
                            <th width="10%">Harga</th>
                            <th width="10%">Jumlah</th>
                            <th width="10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail_pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1; ?>.</td>
                                <td><?= ucwords($value['nama_paket']); ?></td>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td>
                                    <?php if ($value['custom_item'] != null) : ?>
                                        <?= ucwords($value['custom_item']); ?>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?= number_format($value['harga']); ?></td>
                                <td><?= ucwords($value['jumlah']); ?> Box</td>
                                <td>Rp <?= number_format($value['harga'] * $value['jumlah']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-secondary">Kembali</a>
</div>

<?php foreach ($transaksi as $value) : ?>

    <!-- MODAL BUKTI TRANSFER LUNAS -->
    <?php if (!empty($value['bukti_transfer_lunas'])) : ?>
        <div class="modal fade" id="bukti_transfer_lunas<?= $value['kode_pesanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiTransferLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
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
        <div class="modal fade" id="bukti_transfer_dp_awal<?= $value['kode_pesanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAwalLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
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
        <div class="modal fade" id="bukti_transfer_dp_akhir<?= $value['kode_pesanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAkhirLabel<?= $value['id_transaksi']; ?>" aria-hidden="true">
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