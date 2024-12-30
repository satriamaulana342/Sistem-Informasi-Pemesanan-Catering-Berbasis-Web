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
                        <p>total</p>
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
                        <p>: Rp <?= number_format($pesanan['total']); ?>,-</p>
                        <p>: <?= ucwords($pesanan['status_pengiriman']); ?></p>
                        <p>: <?= ucwords($pesanan['keterangan']); ?></p>
                    </div>
                </div>
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
    <a href="<?= base_url('admin/transaksi_perusahaan'); ?>" class="btn btn-secondary">Kembali</a>
</div>